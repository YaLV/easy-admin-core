<?php

namespace App\Providers;

use App\Model\Admin\Menu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Register Plugin View/Migration Directory
        $dir = config('app.plugins', app_path('Plugins'));
        $pluginFolder = new \DirectoryIterator($dir);
        $migrationFolder = [database_path('migrations')];
        foreach ($pluginFolder as $content) {
            if ($content->isDot()) continue;
            // View Directory
            if ($content->isDir() && file_exists($content->getRealPath() . "/views")) {
                View::addNamespace($content->getFilename(), $content->getRealPath() . "/views");
            }

            // Migration Directory
            if ($content->isDir() && file_exists($content->getRealPath() . "/config/database")) {
                $migrationFolder[] = $content->getRealPath() . "/config/database";
            }
        }
        $this->loadMigrationsFrom($migrationFolder);

        // Add Menu, when Menubar exists
        View::composer('admin.partials.sidebar', function ($view) {
            $view->with('menuItems', (new Menu)->getMenuItems());
        });

        View::composer('admin.partials.breadcrumbs', function ($view) {
            $page = Menu::where('routeName', Route::currentRouteName())->first();
            $breadcrumbs = [];
            do {
                $editorId = request()->route('id');
                if($editorId && preg_match("/[{}]/",$page->slug)) {
                    $controller = explode("@", $page->action);
                    $editName = (new $controller[0])->getEditName($editorId);
                    $breadcrumbs[] = (object)['displayName' => $page->displayName.": <strong>".$editName."</strong>"];
                } else {
                    $breadcrumbs[] = $page;
                }
                $page = Menu::find($page->parent_id);
            } while($page);

            $breadcrumbs = array_reverse($breadcrumbs);

            $view->with('breadcrumbs', $breadcrumbs);
        });

        View::composer('admin.*',function($view) {
            $routeName = explode(".", Route::currentRouteName());
            $view->with('currentRoute', $routeName[0]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
