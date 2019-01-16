<?php

return \App\Plugins\Products\Model\Categories\CategoryName::where('language', session('language')??request()->route('lang')??config('app.locale'))->get()->pluck('category_name', 'category_id')->toArray();