<?php

namespace App\Plugins\Admin;

use Illuminate\Http\Request;

interface ControllerInterface
{

    public function index();

    public function edit($id);

    public function add();

    public function store(Request $request, $id = false);

    public function getEditName($id);
}