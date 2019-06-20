<?php

namespace App\Plugins\Orders\Functions;


use App\Plugins\Orders\Model\OrderLines;
use App\Schedules;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

trait OrderSummary
{

    protected $summaryFields = [
        'A' => ['translate' => 'supplier.slug', 'value' => 'supplier_id', 'label' => 'Supplier slug'],
        'B' => ['value' => 'supplier_name', 'label' => 'Supplier Name'],
        'C' => ['value' => 'ordered_at', 'relation' => 'order', 'label' => 'Order Date'],
        'D' => ['fn' => 'getDeliveryDate', 'value' => ['market_day_date', 'delivery'], 'relation' => 'order', 'label' => 'Delivery Date'],
        'E' => ['value' => 'sku', 'label' => 'SKU', 'relation' => 'products'],
        'F' => ['value' => 'product_name', 'label' => 'Product Name'],
        'G' => ['value' => 'amount', 'label' => 'Ordered Amount'],
        'H' => ['value' => 'display_name', 'label' => 'Display'],
        'I' => ['value' => 'cost', 'label' => 'Cost'],
        'J' => ['value' => 'markup', 'label' => 'Markup'],
        'K' => ['fn' => 'getPriceWOvat', 'value' => null, 'label' => 'Price w/o vat'],
        'L' => ['fn' => 'getPriceVat', 'value' => null, 'label' => 'Vat'],
        'M' => ['fn' => 'getPriceWVat', 'value' => null, 'label' => 'Price w/ vat'],
        'N' => ['fn' => 'getDiscount', 'value' => null, 'label' => 'Discount Percent'],
        'O' => ['fn' => 'getDiscountAmount', 'value' => null, 'label' => 'Discount Amount'],
        'P' => ['value' => 'discount_name', 'label' => 'Discount Name'],
        'Q' => ['value' => 'user_id', 'label' => 'User ID'],
        'R' => ['relation' => ['order', 'buyer'], 'value' => ['name', 'last_name'], 'label' => 'User Name/Last Name'],
        'S' => ['relation' => ['order', 'buyer'], 'value' => 'phone', 'label' => 'User Phone'],
        'T' => ['relation' => ['order', 'buyer'], 'value' => 'email', 'label' => 'User email'],
        'U' => ['relation' => 'order', 'value' => 'svaigi_comment_stats', 'label' => 'Svaigi Comment'],
        'V' => ['value' => 'order_header_id', 'label' => 'Order ID'],
        'W' => ['fn' => 'getLinePrice', 'value' => null, 'label' => 'Sum'],
        'X' => ['relation' => 'order', 'value' => 'discount_code', 'label' => 'Discount Code'],
        'Y' => ['fn' => 'getTotalDiscount', 'value' => null, 'label' => 'Discount Total'],
    ];

    /**
     * @var int
     */
    private $index = 2;

    /**
     * @var Schedules
     */
    private $schedule;

    /**
     * @var Worksheet
     */
    private $sheet;

    /**
     * @var array
     */
    private $summaryData;

    /**
     * @var object
     */
    private $price;

    /**
     * @var float
     */
    private $discount;

    /**
     * @param Schedules|null $schedule
     * @param array          $oids
     *
     * @return bool
     */
    public function createOrderSummary(Schedules $schedule = null, $oids = [])
    {

        try {
            if (!$schedule && empty($oids)) {
                return false;
            }


            if ($schedule) {
                $this->schedule = $schedule;
            }


            $excel = new Spreadsheet();
            $this->sheet = $excel->getActiveSheet();
            $this->createHeaders();

            $this->getSummaryData($oids);

            foreach ($this->summaryData as $summaryDataItem) {
                $this->createSummaryLine($summaryDataItem);
                $this->index++;
                $this->price = null;
                $this->discount = null;
                echo "{$this->index} Done-";
            }

            $this->autoSizeColumns();

            $xls = new Xlsx($excel);

            $filename = 'export/summary' . Carbon::now()->timestamp . ".xlsx";

            $xls->save(storage_path("$filename"));

            $this->schedule->update(['result_state' => true, 'running' => false, 'finished' => true, 'result_message' => 'Summary created: <a href="' . route('download', explode("/",$filename)) . '">Download</a>']);
        } catch( \Exception $e) {
            $this->schedule->update(['result_state' => false, 'running' => false, 'finished' => true, 'result_message' => 'Error creating summary: '.$e->getMessage()]);
        }
        return true;
    }

    private function autoSizeColumns() {
        foreach($this->summaryFields as $col => $undef) {
            $this->sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    private function createHeaders()
    {
        foreach ($this->summaryFields as $column => $summaryField) {
            $this->sheet->setCellValue($column . "1", $summaryField['label']);
        }
        $this->sheet->freezePane('A1');
    }

    private function getSummaryData($oids = [])
    {
        if (empty($oids)) {
            $oids = json_decode($this->schedule->filename);
        }

        $this->summaryData = OrderLines::with('order')->whereIn('order_header_id', $oids)->get();
    }

    private function runFN($data, $summaryField) {
        if (method_exists($this, $summaryField['fn'])) {
            echo "Method {$summaryField['fn']} Found \n";
            $fnData = [];
            if (is_array($summaryField['value'])) {
                foreach ($summaryField['value'] as $fieldVal) {
                    $fnData[$fieldVal] = $data->$fieldVal;
                }
            }
            return $this->{$summaryField['fn']}(count($fnData) ? $fnData : $data);
        }
        return "";
    }

    private function runRelation($data, $summaryField) {
        $dataRel = $data;
        if (is_array($summaryField['relation'])) {
            foreach ($summaryField['relation'] as $rel) {
                $dataRel = $dataRel->$rel;
            }
        } else {
            $dataRel = $dataRel->{$summaryField['relation']};
        }

        $dataRel->isOriginal = true;

        if($summaryField['fn']??false) {
            return $this->runFN($dataRel, $summaryField);
        }

        $fieldName = $summaryField['value'];

        if(is_array($fieldName)) {
            $fData = [];
            foreach($fieldName as $fname) {
                $fData[] = $dataRel->$fname;
            }
            return implode(" ", $fData);
        }

        return $dataRel->$fieldName;
    }

    private function createSummaryLine($data)
    {
        foreach ($this->summaryFields as $column => $summaryField) {
            $fieldValue = null;
            switch ($summaryField) {
                /**
                 * Relation fixes
                 */
                case ($summaryField['relation']??false) ? $summaryField : false:
                    $fieldValue = $this->runRelation($data, $summaryField);
                    break;

                case ($summaryField['fn']??false) ? $summaryField : false:
                    $fieldValue = $this->runFN($data, $summaryField);
                    break;

                default:
                    if(is_array($summaryField['value'])) {
                        $fdata = [];
                        foreach($summaryField['value'] as $fval) {
                            $fdata[] = $data->$fval;
                        }
                        $fieldValue = implode(" ", $fdata);
                    } else {
                        $fieldValue = $data->{$summaryField['value']};
                    }
                    break;
            }

            if ($fieldValue) {
                if (($summaryField['translate'] ?? false)) {
                    $fieldValue = __($summaryField['translate']. "." . $fieldValue);
                }

                $this->sheet->setCellValue($column . $this->index, $fieldValue);
            }

        }
    }

    /**
     *
     * @param $data
     *
     * @return array|null|string
     */
    private function getDeliveryDate($data)
    {

        $marketDay = $data['market_day_date'];

        $delivery = $data['delivery'];

        $md = new Carbon($marketDay);

        $dt = $md->copy();
        $modifiedMD = $dt->addDays($delivery->deliveryTime ?? 0);
        $mdDate = $modifiedMD->format('j');
        $month = __("translations." . $modifiedMD->format('F'));
        $dayName = __("translations." . $modifiedMD->format('l'));
        return __('translations.marketDayDeliveryText', ["dayname" => $dayName, 'date' => $mdDate, 'month' => $month]);
    }

    private function getDiscount($data)
    {
        if($this->discount) {
            return $this->discount;
        }
        $this->discountClass = "Sales";
        $discount = $lineDiscount = $data->discount;
        $orderDiscount = $data->order->discount_amount;

        if ($orderDiscount) {
            $discount_target = $data->order->discount_target;
            $discount_items = $data->order->discount_items;

            switch($discount_target) {
                case "product":
                    if(in_array($data->product_id, $discount_items)) {
                        $discount = $orderDiscount>$discount?$orderDiscount:$discount;
                        $this->discountClass = "DiscountCode";
                    }
                    break;

                case "cateogry":
                    $prodCat = $data->products->extra_categories()->pluck('id')->toArray();
                    if(in_array($prodCat,$discount_items)) {
                        $discount = $orderDiscount>$discount?$orderDiscount:$discount;
                        $this->discountClass = "DiscountCode";
                    }
                    break;
            }
        }
        $this->discount = $discount;

        return $discount;
    }

    private function getPrices($data) {
        if (!$this->price) {
            $discount = $this->getDiscount($data);
            $this->price = calcPrice($data->cost, $data->vat_amount, $data->markup, $discount, $data->amount);
        }
    }

    private function getPriceWOvat($data)
    {
        $this->getPrices($data);
        return $this->price->wdiscount->pricewovat;
    }

    private function getPriceVat($data) {
        $this->getPrices($data);
        return $this->price->wdiscount->pricevat;
    }

    private function getPriceWVat($data) {
        $this->getPrices($data);
        return $this->price->wdiscount->price;
    }

    private function getDiscountAmount($data) {
        $this->getPrices($data);
        return $this->price->wdiscount->discount;
    }

    private function getLinePrice($data) {
        $this->getPrices($data);
        return $this->price->sum->wdiscount->wvat;
    }

    private function getTotalDiscount($data) {
        $this->getPrices($data);
        return $this->price->sum->wdiscount->wvat-$this->price->sum->wodiscount->wvat;
    }

}