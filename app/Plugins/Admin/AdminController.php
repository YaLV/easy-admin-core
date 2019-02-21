<?php

namespace App\Plugins\Admin;


use App\Http\Controllers\Controller;
use App\Plugins\Admin\Model\File;
use Illuminate\Http\Request;

/**
 * Class AdminController
 *
 * @package App\Plugins\Admin
 */
class AdminController extends Controller implements ControllerInterface
{
    /**
     * Generate Routes for Admin
     */
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

    /**
     * Upload File route
     *
     * @param Request $request
     *
     * @return array
     */
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

    /**
     * Create Slug route
     *
     * @return array
     */
    public function slugify()
    {
        return ["status" => true, 'slug' => str_slug(request('slugify')), 'message' => "Slug created"];
    }

    /**
     * Defaults to 404 - if undefined
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.errors.404');
    }

    /**
     * Defaults to 404 - if undefined
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.errors.404');
    }

    /**
     * Defaults to 404 - if undefined
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('admin.errors.404');
    }

    /**
     * Defaults to 404 - if undefined
     *
     * @param Request $request
     * @param bool    $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request, $id = false)
    {
        return view('admin.errors.404');
    }

    /**
     * Defaults to not set - if undefined
     *
     * @param $id
     *
     * @return string
     */
    public function getEditName($id)
    {
        return "Error: Not Set";
    }

    /**
     * Form Switch value
     *
     * @param $param
     *
     * @return int
     */
    public function switch($param)
    {
        return ($param ?? false) ? 1 : 0;
    }

    /**
     * Create list of Menubuilder plugins
     *
     * @return array
     */
    public function getApplicableMenuCategories()
    {
        $dir = app_path("Plugins");
        return $this->iteratePlugins($dir);
    }

    /**
     * Iterate Plugins, look for menuData.php file, to include it in menubuilder select
     *
     * @param $dir
     *
     * @return array
     */
    public function iteratePlugins($dir) {

        $menuItems = [];
        $finder = new \DirectoryIterator($dir);
        foreach ($finder as $content) {
            if ($content->isDot()) continue;

            if ($content->isDir() && file_exists(implode("/", [$dir, $content->getFilename(), "menubuilder", "menuData.php"]))) {
                $class = "\\App\\Plugins\\{$content->getFilename()}\\menubuilder\\menuData";
                $menuItems[] = $class::getMenuItems();
            }
        }
        return $menuItems;
    }
}