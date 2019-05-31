<?php

namespace App\Plugins\Orders\Functions;


use App\Mail\OrderSender;
use App\Plugins\Suppliers\Model\Supplier;
use App\Schedules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Finder\SplFileInfo;

trait SendOrders
{
    private $folder;
    private $schedule;
    private $suppliers;

    public function sendEmails(Schedules $schedule = null) {
        $this->folder = storage_path('app/imports/ordersSendPdf');
        $errors = [];

        if($schedule) {
            $this->schedule = $schedule;
        }

        $this->suppliers = __('supplier.slug');

        /** @var SplFileInfo $file */
        foreach($this->getFiles() as $file) {
            $supplier_slug = pathinfo($file->getFilename(), PATHINFO_FILENAME);

            $supplier_id = array_search($supplier_slug, $this->suppliers);
            if($supplier = Supplier::find($supplier_id)) {
                $emailResult = Mail::to($supplier->email)->send(new OrderSender($file, $supplier));

                if(!$emailResult) {
                    $errors[] = "Error sending email to: {$supplier->email}";
                }
            } else {
                $errors[] = "Supplier with slug '$supplier_slug' doesn't exist";
            }
        }

        if(count($this->getFiles()) && $this->schedule) {
            $this->schedule->update(['finished' => true, 'running' => false, 'result_state' => true, 'result_message' => 'Emails Sent']);
        } elseif($this->schedule && $errors) {
            if(count($this->getFiles())) {
                $update = ['finished' => false, 'result_state' => false, 'running' => true];
            } else {
                $update = ['finished' => true, 'result_state' => false, 'running' => false];
            }
            $this->schedule->update(array_merge(['result_message' => implode("<br />", $errors)], $update));
        }
    }


    private function getFiles() {
        return File::files($this->folder);
    }
}