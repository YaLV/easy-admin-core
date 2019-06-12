<?php

namespace App\Plugins\Blog\Functions;


use App\Plugins\Blog\Model\BlogCategories;
use App\Plugins\Products\Model\Product;
use App\Plugins\Suppliers\Model\Supplier;
use Illuminate\Database\Eloquent\Builder;

trait Blog
{

    public function getList($type)
    {
        if ($type == 'posts') {
            return [
                ['field' => 'id', 'translate' => 'posts.name', 'label' => 'Post Title', 'key' => 'id'],
                ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
            ];
        }

        return [
            ['field' => 'name', 'translate' => 'postcategory.name', 'label' => 'Post Category Name', 'key' => 'id'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
        ];
    }

    public function getData($type, $search = false)
    {
        if ($type == 'posts') {
            $posts = new \App\Plugins\Blog\Model\Blog();
            if ($search) {
                $posts = $posts->whereHas('metaData', function (Builder $q) {
                    $q->whereIn('meta_key', ['name'])
                        ->where('meta_value', 'like', '%' . $search . '%');
                });
            }

            return $posts->paginate(20);
        }

        $categories = new BlogCategories();

        if ($search) {
            $categories = $categories->whereHas('metaData', function (Builder $q) {
                $q->whereIn('meta_key', ['name'])
                    ->where('meta_value', 'like', '%' . $search . '%');
            });
        }

        return $categories->paginate(20);
    }

    public function form($type)
    {
        $languages = languages()->pluck('name', 'code');

        if ($type == 'posts') {
            return [
                [
                    'Label'     => 'Display',
                    'languages' => $languages,
                    'data'      => [
                        'name'    => ['type' => 'text', 'meta' => true, 'label' => 'Post Name', 'class' => 'slugify'],
                        'slug'    => ['type' => 'text', 'meta' => true, 'label' => 'Post Slug', 'class' => 'slug', 'readonly' => 'readonly'],
                        'content' => ['type' => 'textarea', 'meta' => true, 'label' => 'Post Content'],
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
                    'Label' => 'Data',
                    'data'  => [
                        'main_category'    => ['type' => 'select', 'options' => BlogCategories::all(), 'label' => 'Main Catetgory'],
                        'extra_categories' => ['type' => 'chosen', 'options' => BlogCategories::all(), 'label' => 'Extra Categories'],
                        'is_highlighted'   => ['type' => 'switch', 'label' => 'Is Highlighted in main page'],
                        'blog_picture'     => ['type' => 'image', 'preview' => true, 'label' => 'Post Image'],
                        'linked_supplier'  => ['type' => 'select', 'label' => 'Linked Supplier(-s)', 'options' => Supplier::all(), 'multiple' => 'multiple', 'dataAttr' => ['live-search' => 'true', 'width' => 'fit', "selected-text-format"=>"count>5"]],
                        'linked_products'  => ['type' => 'select', 'label' => 'Linked Product(-s)', 'options' => Product::all(), 'multiple' => 'multiple', 'dataAttr' => ['live-search' => 'true', 'width' => 'fit', "selected-text-format"=>"count>5"]],
                    ],
                ],
            ];
        }

        return [
            [
                'Label'     => 'Display',
                'languages' => $languages,
                'data'      => [
                    'name' => ['type' => 'text', 'meta' => true, 'label' => 'Category Name', 'class' => 'slugify'],
                    'slug' => ['type' => 'text', 'meta' => true, 'label' => 'Category Slug', 'class' => 'slug', 'readonly' => 'readonly'],
                ],
            ],
        ];
    }
}