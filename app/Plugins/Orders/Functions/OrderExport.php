<?php

namespace App\Plugins\Orders\Functions;


use App\Plugins\Orders\Model\OrderHeader;
use App\Plugins\Orders\Model\OrderLines;
use App\Schedules;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Console\Command;

trait OrderExport
{

    /**
     * @var array
     */
    private $cols = [
        ['key' => 'id', 'name' => 'PRN'],
        ['key' => 'product_id', 'name' => 'Product Id'],
        ['key' => 'product_name', 'name' => 'Product Name'],
        ['key' => 'price', 'name' => 'Price'],
        ['key' => 'display_name', 'name' => 'Info'],
        ['key' => 'amount', 'name' => 'Amount'],
        ['key' => 'real_amount', 'name' => 'Total Package size'],
        ['key' => 'order_header_id', 'name' => 'Order id'],
        ['key' => 'comments', 'name' => 'Comment'],
        ['key' => 'productComment', 'name' => 'Storage Comment'],
    ];


    /**
     * @var Schedules
     */
    private $schedule;

    public function createExcel($schedule)
    {

        /** @var Command $this */
        $this->clearExportFolder();

        $orders = [];

        if($schedule instanceof Schedules) {
            $this->schedule = $schedule;
            $orders = json_decode($this->schedule->filename);
        } else {
            $this->schedule = null;
            if(is_array($schedule)) {
                $orders = $schedule;
            } else {
                $this->error('Unknown Data passed');
            }
        }

        $lastSupplier = null;
        $sheet = $excel = null;
        $line = 0;
        /** @var OrderLines $items */
        foreach (OrderLines::whereIn('order_header_id',$orders)->orderBy('supplier_id', 'asc')->orderBy('created_at', 'asc')->get() as $item) {
            if ($lastSupplier != $item->supplier->meta['slug'][language()]) {
                if ($lastSupplier && $excel) {
                    $this->styleColumns($sheet);
                    $writer = new Xlsx($excel);
                    $writer->save(storage_path('app/imports/ordersExport') . "/$lastSupplier.xlsx");
                    unset($writer);
                }
                $lastSupplier = $item->supplier->meta['slug'][language()];

                /** @var Spreadsheet $excel */
                $excel = new Spreadsheet();
                /** @var OrderHeader $order */
                $order = $item->order;

                $order->setDateFormat('d.m.Y');

                $sheet = $this->createExportHeader($excel->getActiveSheet(), $item->supplier, ["name" => $order->order_market_day->marketDay, "date" => $order->market_day_date]);
                $sheet = $this->createProductLines($sheet, $this->cols, 'header');
                $line = 6;
            }
            if ($sheet) {
                $this->createProductLines($sheet, $item, $line);
                $line++;
            }
        }

        if($excel && $lastSupplier) {
            $writer = new Xlsx($excel);
            $writer->save(storage_path('app/imports/ordersExport') . "/$lastSupplier.xlsx");
        }

        $this->clearOldExports();
        if(count(File::files(storage_path('app/imports/ordersExport')))>0) {
            $filename = $this->createExportZip();
        }
        if($this->schedule) {
            $this->schedule->update(['result_state' => true, 'running' => false, 'finished' => true, 'result_message' => 'Export created: <a href="'.route('download', $filename).'">Download</a>']);
        }
//        $this->info('Export Created');
    }

    private function styleColumns(Worksheet $sheet) {
        $sheet->getStyle("A5:Z5")->getFont()->setBold(true);
        $char = 'A';
        foreach ($this->cols as $col => $field) {
            $sheet->getColumnDimension($char)->setAutoSize(true);
            $char++;
        }
    }

    private function createExportZip() {
        $zip = new \ZipArchive();
        $filepath = "files/order-export.".Carbon::now()->timestamp.".zip";
        $canOpen = $zip->open(storage_path($filepath), \ZipArchive::CREATE);
        if($canOpen) {
            foreach(File::files(storage_path('app/imports/ordersExport')) as $file) {
                $zip->addFile($file->getPathname(), $file->getBasename());
            }
            $zip->close();
            File::cleanDirectory(storage_path('app/imports/ordersExport'));
            return explode("/", $filepath);
        } else {
            if($this->schedule) {
                $this->schedule->update(['result_state' => false, 'result_message' => 'Can not create ZIP']);
                return null;
            } else {
                $this->error("Can not create ZIP");
            }
        }
    }

    private function clearOldExports() {
        foreach(File::files(storage_path('files')) as $file) {
            if($file->getMTime()<Carbon::now()->AddDays(-config('app.exportFileTimeout', 5))->timestamp) {
               unlink($file->getPathname());
            }
        }
    }

    private function createExportHeader(Worksheet $sheet, $supplier, $marketDay)
    {
        $sheet->getStyle(1)->getFont()->setBold(true);
        $sheet->getStyle(2)->getFont()->setBold(true);
        $sheet->getStyle(4)->getFont()->setBold(true);

        $sheet->mergeCells("A1:C1");
        $sheet->setCellValue("A1", __('supplier.name.' . $supplier->id));
        $sheet->mergeCells("A2:C2");
        $sheet->setCellValue("A2", $supplier->email);
        $sheet->mergeCells("A3:C3");
        $sheet->setCellValue("A3", $marketDay['name'][language()]." ".$marketDay['date']);
        $sheet->mergeCells("A4:F4");

        return $sheet;
    }

    private function createProductLines(Worksheet $sheet, $item, $line)
    {
        if ($line == 'header') {
            foreach ($item as $col => $itemValue) {
                $sheet->SetCellValueByColumnAndRow(($col+1), 5, $itemValue['name']);
            }
        } else {
            foreach ($this->cols as $col => $itemKeys) {
                /** @uses OrderExport::getValue() */
                $value = $this->getValue($item, $itemKeys['key']);
                $sheet->SetCellValueByColumnAndRow(($col+1), $line, $value);
            }
        }

        return $sheet;
    }

    private function getValue(OrderLines $item, string $itemKey) {
        switch($itemKey) {
            case "productComment":
                $data = $item->products->info;
                break;

            default:
                $data = $item->$itemKey??"";
                break;
        }
        return $data;
    }

    public function clearExportFolder()
    {
        Storage::delete(Storage::files(storage_path('app/imports/ordersExport')));
    }

}