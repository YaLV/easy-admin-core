<?php

namespace App\Plugins\UserGroups;


use App\Plugins\Admin\AdminController;
use App\Plugins\UserGroups\Functions\UserGroups;
use App\Plugins\UserGroups\Model\UserGroup;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupController extends AdminController
{
    use UserGroups;

    public function index()
    {
        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'User Groups',
                'list'         => UserGroup::all(),
                'idField'      => 'name',
                'destroyName'  => 'User Group',
            ]);
    }

    public function add()
    {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => new UserGroup]);
    }

    public function edit($id)
    {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => UserGroup::findOrFail($id)]);
    }

    public function store(Request $request, $id = false)
    {
        request()->validate([
            'name'       => 'required',
            'min_orders' => 'required',
        ]);

        try {
            DB::beginTransaction();
            UserGroup::updateOrCreate(['id' => $id], request(['name', 'min_orders']));
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();

            return ['success' => false];
        }

        return redirect()->route('usergroup');
    }

    public function delete($id)
    {
        /** @var UserGroup $group */
        $group = UserGroup::findOrFail($id);

        /** @var UserGroup $parentGroup */
        $parentGroup = UserGroup::where('min_orders', '<=', $group->min_orders)->where('id', '!=', $group->id)->orderBy('min_orders', 'desc')->first();

        $parentCat = null;

        if($parentGroup) {
            $parentCat=$parentGroup->id;
        }

        $group->users()->update(['user_group_id' => $parentCat]);

        $result = $group->delete();

        return ['status' => $result, 'message' => ($result ? 'User Group Deleted' : "Error deleting User Group")];
    }
}