<?php

namespace App\Plugins\Menu;

use App\Plugins\Admin\AdminController;
use App\Plugins\Menu\Functions\Menu;
use App\Plugins\Menu\Model\FrontendMenu;
use App\Plugins\Menu\Model\FrontendMenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuAdminController extends AdminController
{
    use Menu;

    public function index()
    {
        return view('admin.elements.table', ['list' => FrontendMenu::all(), 'tableHeaders' => $this->getList(), 'header' => 'Menus', 'showAddButton' => route('menus.add')]);
    }

    public function add()
    {

        $form = $this->form();

        return view('admin.elements.form', ['formElements' => $form, 'content' => new FrontendMenu()]);
    }

    public function edit($id)
    {

        $menu = FrontendMenu::findOrFail($id);
        $form = $this->form();

        if ($menu->protected) {
            $form['data']['name']['readonly'] = "readonly";
        }

        return view('admin.elements.form', ['formElements' => $form, 'content' => $menu, 'modalId' => ['menu' => str_random(10)]]);
    }

    public function store(Request $request, $id = false)
    {
        if ($id) {
            request()->validate([
                'menuContent' => 'required',
            ]);
            $data = ['name' => request('name')];
        } else {
            request()->validate([
                'name' => 'required',
                'slug' => 'required|unique:frontend_menus',
            ]);
            $data = ['name' => request('name'), 'slug' => request('slug')];
        }

        try {
            DB::beginTransaction();
            $menu = FrontendMenu::updateOrCreate(['id' => $id], $data);

            if ($id) {
                $this->handleMenuItems($menu);
            }
            DB::commit();
        } catch (\PDOException $e) {
            abort(500);
            return false;
        }

        if($id) {
            return redirect(route('menus.list'));
        }

        return redirect(route('menus.edit', [$menu->id]));

    }

    public function storeMenuItem($id)
    {

        request()->validate([
            'owner' => 'required',
            'owner_id'   => 'required',
        ]);

        $menu = FrontendMenu::findOrFail($id);

        $item = new FrontendMenuItem([
            'frontend_menu_id' => $id,
            'menu_owner'       => request('owner'),
            'owner_id'         => request('owner_id'),
            'sequence'         => 0,
        ]);

        try {
            DB::beginTransaction();
            $menuItem = $menu->menuItems()->save($item);
            DB::commit();
        } catch (\PDOException $e) {
            abort(500);
            return false;
        }

        return ['status' => true, 'noMessage' => true, 'content' => view("Menu::menuItem", ['menuItem' => $menuItem])->render()];
    }

    public function destroyMenuItem($id) {
        $this->removeMenuItems(FrontendMenuItem::findOrFail($id));
        return ['status' => true, 'message' => 'Menu Item Removed', 'removedId' => $id];
    }

}