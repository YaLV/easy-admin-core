<?php
/**
 * Created by PhpStorm.
 * User: ya
 * Date: 1/24/19
 * Time: 10:22 AM
 */

namespace App\Plugins\Suppliers\Functions;


trait Suppliers
{
    public function form()
    {
        $languages = languages()->pluck('name', 'code');

        return [
            [
                'Label'     => 'Display',
                'languages' => $languages,
                'data'      => [
                    'name'        => ['type' => 'text', 'label' => 'Supplier Name', 'meta' => true, 'class' => 'slugify'],
                    'slug'        => ['type' => 'text', 'label' => 'Supplier Slug', 'meta' => true, 'class' => 'slug', 'readonly' => 'readonly'],
                    'jur_name'    => ['type' => 'text', 'label' => 'Supplier Legal Name', 'meta' => true],
                    'description' => ['type' => 'textarea', 'label' => 'Description', 'meta' => true],
                    'location'    => ['type' => 'text', 'label' => 'Location', 'meta' => true],
                ],
            ],
            [
                'Label'     => 'Google SEO',
                'languages' => $languages,
                'data'      => [
                    'google_keywords'    => ['type' => 'text', 'class' => '', 'label' => 'Keywords', 'meta' => true],
                    'google_description' => ['type' => 'textarea', 'class' => '', 'label' => 'Google Description', 'meta' => true],
                ],
            ],
            [
                'Label' => 'Parameters',
                'data'  => [
                    'custom_id'      => ['type' => 'text', 'label' => 'Supplier ID'],
                    'email'          => ['type' => 'text', 'label' => 'E-mail'],
                    'coords'         => ['type' => 'text', 'label' => 'Google Maps Coordinates'],
                    'farmer'         => ['type' => 'switch', 'label' => 'Farmer'],
                    'craftsman'      => ['type' => 'switch', 'label' => 'Craftsman'],
                    'featured'       => ['type' => 'switch', 'label' => 'Featured'],
                    'supplier_image' => ['type' => 'image', 'preview' => true, 'label' => 'Supplier image'],
                ],
            ],
        ];
    }

    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Supplier Name', 'translate' => 'supplier.name', 'key' => 'id'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => '',],
        ];
    }
}