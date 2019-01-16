<?php

namespace App\Plugins\Menu\Functions;

trait Menu {

    public function form() {
        return [];
    }

    public function getList() {
        return [
          ['field' => 'id', 'label' => '#', 'sortGrab' => true],
          ['field' => 'name', 'label' => 'Menu Name'],
          ['field' => 'buttons', 'buttons' => ['edit', 'delete', 'state'], 'label' => ''],
        ];
    }

    public function getApplicableMenus() {
        $menuItems = [];

        $defaultNamespace = ["App","Plugins"];

        $dir = config('app.plugins', app_path('Plugins'));
        $pluginFolder = new \DirectoryIterator($dir);
        foreach($pluginFolder as $content) {
            $namespace = $defaultNamespace;
            if ($content->isDot()) continue;

            if ($content->isDir() && file_exists($content->getRealPath() . "/".$content."MenuController.php")) {
                $namespace[] = $content->getBasename();
                $namespace[] = $content."MenuController";
                $controller = implode($namespace);
                if(method_exists(new $controller, "menuItems")) {
                    $menuItems = array_merge($menuItems, (new $controller)->menuItems());
                }
            }
        }
        return $menuItems;
    }
}