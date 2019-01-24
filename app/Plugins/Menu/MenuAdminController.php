<?php

namespace App\Plugins\Menu;

use App\Plugins\Admin\AdminController;
use App\Plugins\Menu\Functions\Menu;
use App\Plugins\Menu\Model\FrontendMenu;

class MenuAdminController extends AdminController
{
    use Menu;

    public function index() {
        return view('admin.elements.table', ['list' => FrontendMenu::all(), 'tableHeaders' => $this->getList(), 'header' => 'Menus', 'showAddButton' => route('menus.add')]);
    }

    public function add() {

        $menuItems = $this->getApplicableMenus();

        return view('Menu::newMenu', ['menuItems' => $menuItems]);
    }

    public function edit($id) {

    }
}