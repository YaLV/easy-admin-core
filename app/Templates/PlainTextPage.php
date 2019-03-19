<?php

namespace App\Templates;


use App\Plugins\Pages\Functions\Components;

class PlainTextPage
{
    use Components;

    public static function getTemplateName() {
        return "Plain Text Page";
    }

    public function components() {
        return [
            'spacerSmall',
            'plainText'
        ];
    }
}