<?php

namespace App\Plugins\Products\Functions;


use App\Languages;
use App\Plugins\Admin\Model\File;

trait Category
{
    public function getList()
    {
        return [
            ['field' => 'name', 'label' => 'Category Name', 'translate' => 'categoryNames', 'key' => 'id'],
            ['field' => 'slug', 'label' => 'Category Slug', 'translate' => 'categorySlugs', 'key' => 'id'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete'], 'label' => ''],
        ];
    }

    public function form()
    {
        return [
            [
                'Label'     => 'Display',
                'languages' => Languages::all()->pluck('name', 'code'),
                'data'      => [
                    'name' => ['type' => 'text', 'class' => '', 'label' => 'Category Name'],
                ],
            ],
            [
                'Label'     => 'SEO',
                'languages' => Languages::all()->pluck('name', 'code'),
                'data'      => [
                    'keywords'       => ['type' => 'text', 'class' => '', 'label' => 'Keywords'],
                    'description'    => ['type' => 'textarea', 'class' => '', 'label' => 'Google Description'],
                    'og_title'       => ['type' => 'text', 'class' => '', 'label' => 'OG/Twitter Title'],
                    'og_description' => ['type' => 'textarea', 'class' => '', 'label' => 'OG/Twitter Description'],
                ],
            ],
            [
                'Label' => 'Parameters',
                'data'  => [
                    'parent_id'      => ['type' => 'select', 'options' => getTranslations("categoryNames", \App\Plugins\Products\Model\Categories\Category::all()), 'label' => 'Parent Category'],
                    'category_image' => ['type' => 'image', 'label' => 'Category Header Image', 'preview' => true],
                ],
            ],
        ];
    }

    public function handleImages($category)
    {

        $x = 0;
        list($urls, $main, $id) = [request('image_url'), request('image_main'), request('image_id')];

        $type = "image";

        $imagesInFiles = $category->images()->get()->pluck('id')->toArray();

        foreach(array_diff($imagesInFiles, $id) as $fileID) {
            $file = File::find($fileID);
            $file->delete();
            unlink(storage_path(str_replace('/storage', 'app/public', $file->filePath)));
        }

        do {
            $file = File::findOrFail($id[$x]);
            $file->main = $main[$x]??0;
            $file->owner_id = $category->id;
            $file->fileType = $type;
            $file->save();
            $x++;
        } while ($urls[$x]??false);

    }
}