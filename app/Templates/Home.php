<?php

namespace App\Templates;


use App\Plugins\Pages\Functions\Components;

class Home
{
    use Components;

    public static function getTemplateName() {
        return "Homepage";
    }

    public function components()
    {
        return [
            'fullSizeBanner',
            'doubleBanner',
            'spacerSmall',
            'centeredTitle',
            'spacerMedium',
            'popular',
            'spacerMedium',
            'featuredSupplier',
            'spacerMedium',
            'centeredTitle',
            'spacerMedium',
            'blogposts',
            'spacerMedium',
            'howithappens',
        ];
    }
}