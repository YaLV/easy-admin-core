<?php

namespace App\Plugins\Orders\Functions;


use App\Plugins\Orders\Model\OrderLines;
use App\Schedules;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Barryvdh\DomPDF\Facade as PDF;
use Symfony\Component\Finder\SplFileInfo;

trait OrderImport
{
    /**
     * @var array
     */
    private $cols = [
        ['key' => 'id', 'name' => 'PRN', 'type' => 'identify'],
        ['key' => 'product_id', 'name' => 'Product Id', 'type' => 'identify'],
//        ['key' => 'product_name', 'name' => 'Product Name'],
//        ['key' => 'price', 'name' => 'Price'],
//        ['key' => 'display_name', 'name' => 'Info', 'type' =>'update' ],
//        ['key' => 'amount', 'name' => 'Amount'],
        ['key' => 'real_amount', 'name' => 'Total Package size', 'type' => 'update'],
//        ['key' => 'order_header_id', 'name' => 'Order id'],
        ['key' => 'comments', 'name' => 'Comment', 'type' => 'change'],
//        ['key' => 'productComment', 'name' => 'Storage Comment'],
    ];

    /**
     * @var array
     */
    private $pdfCols = [
//        ['key' => 'id', 'name' => 'PRN', 'type' => 'identify'],
        ['key' => 'product_id', 'name' => 'Product Id', 'type' => 'identify', 'mutate' => 'int'],
        ['key' => 'product_name', 'name' => 'Product Name', 'type' => 'identify'],
//        ['key' => 'price', 'name' => 'Price'],
        ['key' => 'display_name', 'name' => 'Info', 'type' => 'identify'],
        ['key' => 'amount', 'name' => 'Amount', 'type' => 'identify', 'mutate' => 'int'],
//        ['key' => 'real_amount', 'name' => 'Total Package size', 'type' => 'update'],
        ['key' => 'order_header_id', 'name' => 'Order id', 'type' => 'identify', 'mutate' => 'int'],
        ['key' => 'comments', 'name' => 'Comment', 'type' => 'identify'],
        ['key' => 'productComment', 'name' => 'Storage Comment', 'type' => 'identify'],
    ];

    /**
     * @var Schedules
     */
    private $schedule;

    /**
     * @var array
     */
    private $files;

    /**
     * @var string
     */
    private $columns = "ABCDEFGHIJKLMOPQRSTU";

    /**
     * @var array
     */
    private $currentColumns = [];

    /**
     * importFN
     *
     * @var string
     */
    private $fn;

    /**
     * @var string
     */
    private $successMessage;

    /**
     * @var array
     */
    private $allPDF = [];

    /**
     * @var string
     */
    private $md = "Pirmdiena";

    /**
     * @param Schedules|null $schedule
     */
    public function createPDF(Schedules $schedule = null)
    {
        if ($schedule) {
            $this->schedule = $schedule;
        }

        $this->fn = "createPDFDocs";

        $this->getImportList(storage_path('app/imports/ordersSend'));

        if ($this->readExcel('pdfCols')) {

            $masterfilename = $this->createMasterPDF();

            $this->successMessage = 'PDF created <a href="'.route('download', ['files',$masterfilename]).'">Download</a>';

            $this->saveResult();
        }
    }

    /**
     *  Creates master PDF for viewing
     */
    private function createMasterPdf()
    {
        $this->removeOldMasterPDF();

        $masterFile = storage_path("files") . "/master-" . Carbon::now()->timestamp . ".pdf";

        PDF::loadView("Orders::pdf.master", ['master' => $this->allPDF, 'colcount' => count($this->pdfCols), 'marketday' => $this->md, 'headers' => $this->pdfCols])->save($masterFile);

        return basename($masterFile);
    }

    /**
     * Removes old PDF files
     */
    private function removeOldMasterPDF()
    {
        foreach (File::files(storage_path('files')) as $file) {
            if ($file->getMTime() < Carbon::now()->AddDays(-config('app.exportFileTimeout', 5))->timestamp) {
                unlink($file->getPathname());
            }
        }
    }

    /**
     * @param Schedules|null $schedule
     */
    public function import(Schedules $schedule = null)
    {
        if ($schedule) {
            $this->schedule = $schedule;
        }

        $this->fn = "updateOrders";
        $this->successMessage = "Import Successful";

        $this->getImportList(storage_path('app/imports/ordersUpdate'));

        if ($this->readExcel('cols')) {
            $this->saveResult();
        }
    }

    /**
     * Saves Result for schedule
     */
    private function saveResult()
    {
        if ($this->schedule) {
            $this->schedule->fill([
                'result_state'   => 1,
                'finished'       => 1,
                'running'        => 0,
                'result_message' => $this->successMessage,
            ]);
            $this->schedule->save();
        }
    }

    /**
     * Import Order updates
     *
     * @returns boolean
     */
    public function readExcel($colobj)
    {
        foreach ($this->files as $importFile) {
            foreach (['Xls', 'Xlsx'] as $class) {
                $fullclass = "PhpOffice\\PhpSpreadsheet\\Reader\\" . $class;
                /** @var Xls|Xlsx $reader */
                $reader = new $fullclass;

                if (File::exists($importFile) && $reader->canRead($importFile)) {
                    $reader->setLoadAllSheets();
                    $xls = $reader->load($importFile);

                    $sheet = $xls->getSheet(0);
                    $this->getColumnOrder($sheet, $this->$colobj);

                    $totalLines = $sheet->getHighestRow();

                    /** @uses OrderImport::createPDFDocs()
                     * @uses OrderImport::updateOrders()
                     */
                    $this->{$this->fn}($sheet, $totalLines, $importFile);
                } else {
                    continue;
                }
            }
        }

        return true;
    }

    /**
     * @used-by OrderImport::readExcel() to create pdf
     *
     * @param $sheet
     * @param $totalLines
     * @param $currentLine
     * @param $importFile
     */
    private function createPDFDocs(Worksheet $sheet, $totalLines, SplFileInfo $importFile)
    {


        $farmerName = $sheet->getCell("A1")->getCalculatedValue();
        $farmerEmail = $sheet->getCell("A2")->getCalculatedValue();
        $comment = $sheet->getCell("A4")->getCalculatedValue();

        $lineContent = [];

        $currentLine = 6;
        foreach (range($currentLine, $totalLines) as $line) {
            list($lineID, $content, $order) = $this->getLineContent($sheet, $line, $this->pdfCols);
            $lineContent[] = $lineID;
        }

        $this->allPDF[] = [
            'farmer' => $farmerName,
            'email'  => $farmerEmail,
            'comment' => $comment,
            'lines'  => $lineContent,
        ];

        $pdfFileName = pathinfo($importFile->getFilename(), PATHINFO_FILENAME);

        PDF::loadView("Orders::pdf.headers", ['lines' => $lineContent, 'farmer' => $farmerName, 'email' => $farmerEmail, 'colcount' => count($this->pdfCols), 'marketday' => $this->md, 'headers' => $this->pdfCols])->save(storage_path('app/imports/ordersSendPdf') . "/" . implode(".", [$pdfFileName, "pdf"]));

    }


    /**
     * @used-by OrderImport::readExcel() to import order update
     *
     * @param Worksheet $sheet
     * @param           $totalLines
     * @param           $importFile
     */
    private function updateOrders(Worksheet $sheet, $totalLines, $importFile)
    {
        $currentLine = 6;

        foreach (range($currentLine, $totalLines) as $line) {
            list($lineID, $content, $order) = $this->getLineContent($sheet, $line, $this->cols);

            /** @var OrderLines $orderLine */
            $orderLine = OrderLines::updateOrCreate($lineID, $content);

            $orderLine->order()->update($order);
        }
        unlink($importFile);
    }


    /**
     * Read import folder, and save contents to array
     */
    private function getImportList($path)
    {
        $this->files = File::files($path);
    }

    /**
     * Read excel, and find columns for saveable data
     *
     * @param Worksheet $sheet
     */
    private function getColumnOrder(Worksheet $sheet, array $colObj)
    {
        $x = 0;
        while ($cell = $sheet->getCell($this->columns[$x] . "5")) {
            if ($x == (count(str_split($this->columns, 1)) - 1)) {
                break;
            }
            $header = $cell->getCalculatedValue();
            $index = array_search($header, array_column($colObj, "name"));
            if (is_int($index)) {
                $this->currentColumns[$this->columns[$x]] = $colObj[$index]['key'];
            }
            $x++;
        }
    }

    /**
     * Read line content
     *
     * @param Worksheet $sheet
     * @param           $line
     * @param array     $colObj
     *
     * @return array
     */
    private function getLineContent(Worksheet $sheet, $line, $colObj)
    {
        $identify = $update = $change = [];
        foreach ($this->currentColumns as $column => $field) {

            $index = array_search($field, array_column($colObj, "key"));

            if (is_int($index)) {
                $value = $sheet->getCell($column . $line)->getValue();
                if($colObj[$index]['mutate']??false) {
                    /** @uses OrderImport::int() */
                    $value = $this->{$colObj[$index]['mutate']}($value);
                }
                ${$colObj[$index]['type']}[$field] = $value;
            }
        }

        return [$identify, $update, $change];
    }

    /**
     * @used-by OrderImport::getLineContent()
     */
    private function int($val) {
        return (int)$val;
    }
}