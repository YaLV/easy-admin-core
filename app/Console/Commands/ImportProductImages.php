<?php

namespace App\Console\Commands;

use App\Functions\General;
use App\Http\Controllers\CacheController;
use App\Plugins\Products\Model\Product;
use App\Schedules;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class ImportProductImages extends Command
{

    use General;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'svaigi:importImages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds uploaded images to products';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        /** @var Schedules $schedule */
        $schedule = Schedules::where(['running' => 0, 'type' => 'productImageImport', 'finished' => 0])->orWhere(function (Builder $q) {
            $q->where('running', 1)
                ->where('updated_at', '>=', Carbon::now()->addMinutes(-5))
                ->where('type', 'productImageImport')
                ->where('finished', 0);
        })->first();

        if($schedule) {
            $schedule->update(['running' => 1]);
        }

        $c = new \App\Plugins\Admin\AdminController;

        foreach(Storage::files('imports/product_images/') as $file) {
            list($sku,$extension) = explode(".", basename($file));

            $product = Product::withTrashed()->where('sku', $sku)->first();

            if($product) {
                $req = new \Illuminate\Http\Request();

                $req->files->add(['product_image' => [new \Illuminate\Http\UploadedFile(storage_path('app/'.$file), basename($file))]]);
                $req->setMethod('POST');
                $req->request->add(['path' => 'product_image', 'owner' => 'product_image']);

                $result = $c->uploadFile($req, true);

                $files = [];
                foreach($result['data'] as $res) {
                    $files[0][] = $res->filePath;
                    $files[1][] = $res->main;
                    $files[2][] = $res->id;
                }
                $this->handleImages($product, false, $files);
                (new CacheController)->createProductCache($product->id, true);
                $product->forgetMeta(['slug', 'name']);
            }

            Storage::delete($file);
        }

        if(!count(Storage::files('imports/product_images/')) && $schedule) {
            $schedule->update(['running' => 0, 'finished' => 1, 'result_state' => 1, 'result_message' => 'Images Uploaded']);
        }

        $this->info('All Images Uploaded');
        return true;
    }
}
