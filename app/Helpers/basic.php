<?php


function language() {
    return session('locale')??config('locale');
}

function languages() {
    return \App\Languages::all();
}

function getTranslations($path, $collections) {
    $collectionTranslates = [];
    foreach($collections as $collection) {
        $collectionTranslates[] = (object)['id' => $collection->id, 'name' => __("$path.{$collection->id}")];
    }
    return (object)$collectionTranslates;
}