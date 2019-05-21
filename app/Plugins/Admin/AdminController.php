<?php

namespace App\Plugins\Admin;


use App\Http\Controllers\Controller;
use App\Plugins\Admin\Model\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

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
    public function uploadFile(Request $request, $onlyData = false)
    {

        $uploadPath = $request->get('path');

        $returnData = [];
        if ($request->hasFile($uploadPath)) {
            foreach ($request->file($uploadPath) as $uploadedFile) {

                $imageSizes = config("app.imageSize." . $uploadPath, null);
                $fileSavePath = (config("app.uploadFile.$uploadPath") ?? 'temp');
                if (!$imageSizes) {
                    $filename = basename($uploadedFile->store("public/" . $fileSavePath . "/original"));

                    $returnData[] = $this->saveFileDB($filename, $fileSavePath, 'original', $request->get('owner'));

                    continue;
                }

                /** @var Image $upImage */
                $upImage = Image::make($uploadedFile->getRealPath());
                list($origW, $origH) = [$upImage->width(), $upImage->height()];

                $filename = str_random(40);
                $fileExt = $uploadedFile->getClientOriginalExtension();
                $saveFileName = "$filename.$fileExt";

                foreach ($imageSizes as $imageType => $imageSize) {
                    $upImage->backup();
                    list($width, $height) = explode("x", $imageSize);

                    if ($origW != $origH && $width && $height) {
                        $upImage->resize(($origH >= $origW ? $width : null), ($origW >= $origH ? $height : null), function ($l) {
                            $l->aspectRatio();
                        });
                        $upImage->crop($width, $height);
                    } else {
                        $upImage->resize($width, $height, function ($l) {
                            $l->aspectRatio();
                        });
                    }

                    if (!\Storage::exists("public/$fileSavePath/$imageSize/")) {
                        \Storage::makeDirectory("public/$fileSavePath/$imageSize/");
                    }
                    $upImage->save(storage_path("app/public/$fileSavePath/$imageSize/$saveFileName"), 100);
                    $upImage->reset();
                }
                $returnData[] = $this->saveFileDB($saveFileName, $fileSavePath, current($imageSizes), $request->get('owner'), $onlyData);
            }

            return ["status" => true, 'message' => 'File Uploaded, please save form, to add file to current item', 'data' => $returnData];
        } elseif ($request->hasFile('importFile')) {
            $plugin = request()->get('plugin');
            $controller = request()->get('controller');
            $method = request()->get('method') ?? 'import';
            $uploadTargetClassName = "\\App\\Plugins\\$plugin\\$controller";
            $uploadTargetClass = new $uploadTargetClassName ?? null;

            if ($uploadTargetClass instanceOf $uploadTargetClassName && method_exists($uploadTargetClass, $method)) {
                return $uploadTargetClass->$method();
            }

        }

        return ["status" => false, 'message' => 'Missing upload parameters'];
    }

    /**
     * @param      $filename
     * @param      $path
     * @param null $size
     *
     * @return View|array
     */
    private function saveFileDB($filename, $path, $size = null, $owner = false, $onlyData = false)
    {
        $file = File::create([
            'main'     => false,
            'filePath' => $filename,
            'owner'    => $owner,
        ]);

        if ($onlyData) {
            return $file;
        }

        return view('Admin::fields.imagePreview', ['image' => $file, "path" => $size, 'owner' => $path])->render();
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
    public function iteratePlugins($dir)
    {

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

    public function downloadFile($dir, $file)
    {
        /** @var \Illuminate\Support\Facades\File $fileManager */
        $fileManager = new \Illuminate\Support\Facades\File();
        $response = new Response();

        if (\Illuminate\Support\Facades\File::isDirectory(storage_path($dir)) && \Illuminate\Support\Facades\File::exists(storage_path("$dir/$file"))) {
            $response = new Response();
            $response->header(    'Content-Type', \Illuminate\Support\Facades\File::mimeType(storage_path("$dir/$file")));
            $response->header('Content-Disposition', "attachment; filename='$file'");
            $response->header('Content-Length', \Illuminate\Support\Facades\File::size(storage_path("$dir/$file")));
            $response->setContent(\Illuminate\Support\Facades\File::get(storage_path("$dir/$file")));
        } else {
            abort(404);
        }

        return $response;
    }
}