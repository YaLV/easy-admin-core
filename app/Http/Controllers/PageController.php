<?php

namespace App\Http\Controllers;

use App\Plugins\Pages\Functions\Page;
use App\Plugins\Pages\Model\PageMeta;

class PageController extends Controller
{
    use Page;

    public function show($pageSlug, $level2Slug = false, $level3Slug = false) {

        $title = false;
        if(!pageTable()) {
            abort(404, "No Page Table!");
        }

        $page = (new CacheController)->getPage($pageSlug);

        if(!$page) {
            return view('frontend.pages.page', ['page' => $page, 'components' => [], 'pageTitle' => ""]);
        }

        if($page->hasChildren && $level2Slug) {
            $className = "App\\Templates\\".ucfirst($page->template);

            /** @noinspection PhpUndefinedMethodInspection */
            return $className::childView($level2Slug, $page);
        }

        if(!$page->pageData->homepage) {
            $title = _t('pages.name.'.$page->id);
        }

        return view('frontend.pages.page', ['page' => $page, 'components' => $page->components, 'pageTitle' => $title]);

    }
}
