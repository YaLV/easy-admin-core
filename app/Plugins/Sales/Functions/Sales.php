<?php

namespace App\Plugins\Sales\Functions;


use App\Plugins\Categories\Model\CategoryMeta;
use App\Plugins\Products\Model\ProductMeta;
use App\Plugins\UserGroups\Model\UserGroup;
use App\User;
use Illuminate\Support\Facades\DB;

trait Sales
{

    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Name'],
            ['field' => 'buttons', 'label' => '', 'buttons' => ['edit', 'delete']],
        ];
    }

    public function form()
    {
        return [
            'data' => [
                'name'            => ['type' => 'text', 'label' => 'Name'],
                'amount'          => ['type' => 'text', 'label' => 'Discount amount'],
                'discount_to'     => ['type' => 'select', 'label' => 'Applied to', 'class' => 'changeDT', 'options' => (object)[(object)['id' => 'product', 'name' => 'Products'], (object)['id' => 'category', 'name' => 'Categories']]],
                'discount_target' => ['type' => 'text', 'label' => 'Discount Targets', 'class' => 'autocomplete target', 'dataAttr' => ['searchurl' => route('promotions.load', ['discount_to'])]],
                'group'           => ['type' => 'text', 'label' => 'User Group', 'class' => 'autocomplete', 'dataAttr' => ['searchurl' => route('promotions.load', ['usergroup'])]],
                'valid_from'      => ['type' => 'text', 'label' => 'Valid From', 'class' => 'datepicker'],
                'valid_to'        => ['type' => 'text', 'label' => 'Valid to', 'class' => 'datepicker'],
            ],
        ];
    }

    public function listOptions($target)
    {
        $data = ['No results'];
        switch ($target) {
            case "category":
                $data = CategoryMeta::where('meta_name', 'name')->where('meta_value', 'like', '%' . request('term') . '%')->get()->pluck('meta_value')->toArray() ?: $data;
                break;
            case "usergroup":
                $data = UserGroup::where('name', 'like', '%' . request('term') . '%')->get()->pluck('name')->toArray() ?: $data;
                break;
            case "user":
                $data = User::where('name', 'like', '%' . request('term') . '%')
                        ->orWhere('last_namename', 'like', '%' . request('term') . '%')
                        ->orWhere('email', 'like', '%' . request('term') . '%')
                        ->orWhere('legal_name', 'like', '%' . request('term') . '%')
                        ->select(DB::raw("concat_ws(' ', name, last_name) as fullname"))
                        ->pluck('fullname')
                        ->toArray() ?? $data;
                break;
            case "product":
                $data = ProductMeta::where('meta_name', 'name')->where('meta_value', 'like', '%' . request('term') . '%')->get()->pluck('meta_value')->toArray() ?: $data;
                break;
        }

        return array_merge($data, ['noMessage' => true]);
    }

}