<?php

namespace App\Providers;

use App\Http\Controllers\CacheController;
use App\Http\Controllers\FrontController;
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
        // Send current language
        View::share("pageLanguage", language());
        View::share("frontController", new FrontController);
        View::share("cache", new CacheController);

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

        // Add Admin Menu, when Menubar exists
        View::composer('admin.partials.sidebar', function ($view) {
            $view->with('menuItems', (new Menu)->getMenuItems());
        });

        // Add breadcrumbs in admin
        View::composer('layouts.admin', function ($view) {
            $page = Menu::where('routeName', Route::currentRouteName())->first();
            $breadcrumbs = $title = [];
            do {
                $editorId = request()->route('id');
                if($editorId && preg_match("/[{}]/",$page->slug)) {
                    $controller = explode("@", $page->action);
                    $editName = (new $controller[0])->getEditName($editorId);
                    $pageEl = (object)['displayName' => $page->displayName.": <strong>".$editName."</strong>"];
                    $breadcrumbs[] = $pageEl;
                } else {
                    $breadcrumbs[] = $page;
                }

                $page = Menu::find($page->parent_id??false);
            } while($page);

            $breadcrumbs = array_reverse($breadcrumbs);

            foreach($breadcrumbs as $crumb) {
                $title[] = strip_tags($crumb->displayName??ucfirst(Route::currentRouteName()));
            }
            $view->with('title', implode("::", $title));

            $view->with('breadcrumbs', $breadcrumbs);
        });

        // Admin pages - send current Route Name
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
