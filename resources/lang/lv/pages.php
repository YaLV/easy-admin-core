<?php
$defaultRoute = ['slug' => ['404']];

if(!pageTable()) {
    return $defaultRoute;
}
$routes = (new \App\Plugins\Pages\Model\Page)->MetaLanguage();

if(!$routes) {
    return $defaultRoute;
}