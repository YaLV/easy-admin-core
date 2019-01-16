<?php

return \App\Plugins\Products\Model\Categories\CategorySlug::where('language', session('language')??request()->route('lang')??config('app.locale'))->get()->pluck('category_slug', 'category_id')->toArray();