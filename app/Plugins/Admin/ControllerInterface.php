<?php

namespace App\Plugins\Admin;

use Illuminate\Http\Request;

/**
 * Interface ControllerInterface
 *
 * @package App\Plugins\Admin
 */
interface ControllerInterface
{

    /**
     * @return mixed
     */
    public function index();

    /**
     * @param $id
     *
     * @return mixed
     */
    public function edit($id);

    /**
     * @return mixed
     */
    public function add();

    /**
     * @param Request $request
     * @param bool    $id
     *
     * @return mixed
     */
    public function store(Request $request, $id = false);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getEditName($id);
}