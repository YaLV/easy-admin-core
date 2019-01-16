<?php

namespace App\Plugins\Admin;


use App\Http\Controllers\Controller;
use App\Plugins\Admin\Model\File;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public static function adminRoutes()
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('menus')) {
            foreach (\App\Model\Admin\Menu::all() as $menuItem) {
                if ($menuItem->action) {
                    \Route::{$menuItem->method}(implode("/", array_merge(["/"], $menuItem->getSlug($menuItem->slug ?? ''))), $menuItem->action)->name($menuItem->routeName);
                }
            }
        }
    }

    public function uploadFile(Request $request)
    {
        $uploadFileName = request('path');
        $returnData = [];
        if ($request->hasFile($uploadFileName)) {
            foreach ($request->file($uploadFileName) as $uploadedFile) {
                $filename = $uploadedFile->store("public/" . (config("app.uploadFile.$uploadFileName") ?? "temp"));
                $file = File::create([
                    'main'     => false,
                    'filePath' => "/" . str_replace('public', 'storage', $filename),
                    'owner'    => request('owner'),
                ]);

                $returnData[] = view('Admin::fields.imagePreview', ['image' => $file])->render();
            }
        }

        return ["status" => true, 'message' => 'File Uploaded, please save form, to add file to current item', 'data' => $returnData];
    }
}