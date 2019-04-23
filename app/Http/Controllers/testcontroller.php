<?php

namespace App\Http\Controllers;

use App\Plugins\Products\Functions\ProductImport;
use Illuminate\Http\Request;

class testcontroller extends Controller
{
    use ProductImport;

    public function __construct() {
        $this->readImportData(['filename' => 'example.csv', 'stopped_at' => 0]);
    }
}
