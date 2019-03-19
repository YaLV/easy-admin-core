<?php

namespace App\Templates;

use App\Plugins\Pages\Functions\Components;

class Delivery
{
    use Components;

    public static function getTemplateName()
    {
        return "Delivery Options";
    }

    public function components()
    {
        return [
            'spacerMedium',
            'centeredText',
            'spacerMedium',
            'centeredTitle',
            'spacerMedium',
            'deliveryOption',
            'spacerMedium',
            'centeredTitle',
            'spacerSmall',
            'centeredText',
            'spacerMedium',
            'pickupMap',
        ];
    }
}