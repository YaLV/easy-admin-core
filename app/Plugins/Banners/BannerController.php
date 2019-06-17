<?php

namespace App\Plugins\Banners;


use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\Banners\Functions\Banners;
use App\Plugins\Banners\Model\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class BannerController
 *
 * @package App\Plugins\Banners
 * @property string $type
 */
class BannerController extends AdminController
{

    use General;
    use Banners;

    /**
     * @var string $type
     */
    private $type;

    public function index()
    {
        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => "Banners",
                'list'         => Banner::paginate(20),
                'idField'      => 'title',
                'destroyName'  => "Banner",
            ]);
    }

    public function addMessage()
    {
        $this->type = "message";

        return $this->add();
    }

    public function addPopup()
    {
        $this->type = "popup";

        return $this->add();
    }

    public function add()
    {
        return view('admin.elements.tabForm', [
            'formElements' => $this->form(),
            'content'      => new Banner,
            'css'          => [
                'css/daterangepicker.min.css',
                'css/colorpicker.css',
            ],
            'js'           => [
                'js/moment.js',
                'js/jquery.daterangepicker.min.js',
                'js/colorpicker.js',
            ],
        ]);
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        $this->type = $banner->type;

        return view('admin.elements.tabForm', [
            'formElements' => $this->form(),
            'content'      => $banner,
            'css'          => [
                'css/daterangepicker.min.css',
                'css/colorpicker.css',
            ],
            'js'           => [
                'js/moment.js',
                'js/jquery.daterangepicker.min.js',
                'js/colorpicker.js',
            ],
        ]);
    }

    public function store(Request $request, $id = false)
    {

        $request->validate([
            'frequency' => 'required',
            'dates'     => 'required',
            'title'     => 'required',
        ]);

        try {
            DB::beginTransaction();

            $metas = [
                'message',
                'url',
                'target',
                'image',
            ];
            list($dateFrom, $dateTo) = array_pad(explode(" ~ ", (request('dates') ?? "")), 2, '');

            $df = new Carbon($dateFrom);
            $dt = new Carbon($dateTo);
            /** @var Banner $banner */
            $banner = Banner::updateOrCreate(['id' => $id], array_merge(request([
                'title',
                'frequency',
                'type',
            ]), [
                    'dateFrom' => $df->format('Y-m-d H:i:s'),
                    'dateTo'   => $dt->format('Y-m-d H:i:s'),
                    'colors'   => request(['color_text', 'color_url', 'color_background']),
                ]
            ));
            $banner->categories()->sync(request('categories'));
            $languages = $this->handleImages($banner);
            $this->handleMetas($banner, $metas, false, array_merge(request(['message', 'target']), ['image' => $languages, 'url' => $this->fixUrl(request('url'))]));

            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();

            return redirect()->back()->withInput(request()->all())->with(['message' => ['msg' => $e->getMessage(), 'isError' => true]]);
        }

        return redirect(route('banners.list'));

    }

    public function getEditName($id)
    {
        return Banner::find($id)->title;
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        $banner->metaData()->delete();

        return ['status' => true, "message" => "Banner Deleted"];

    }

    public function fixUrl($url)
    {
        if (strpos($url, 'http') !== false) {
            return $url;
        }

        return "http://$url";
    }

}