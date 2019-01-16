<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController implements ControllerInterface
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('admin.errors.404');
    }

    public function edit($id)
    {
        return view('admin.errors.404');
    }

    public function add()
    {
        return view('admin.errors.404');
    }

    public function store(Request $request, $id = false)
    {
        return view('admin.errors.404');
    }

    public function getEditName($id)
    {
        return "Error: Not Set";
    }
}
