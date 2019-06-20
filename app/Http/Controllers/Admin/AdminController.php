<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index() {

        if(\Auth::user() && \Auth::user()->isAdmin) {
            return redirect()->route('orders');
        }
        return redirect()->route('login');
    }

}
