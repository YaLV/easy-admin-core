<?php

namespace App\Functions;

use App\BaseModel;
use App\Plugins\Admin\Model\File;

trait General
{
    public function handleMetas($collection, $metas, $slug = false, $metaData = false)
    {

        /** @var BaseModel $collection */

        $metaData = $metaData?:request($metas);

        foreach ($metas as $meta) {
            foreach (languages() as $language) {
                if (!($metaData[$meta][$language->code] ?? false) && $meta != 'slug') continue;
                $meta_value = $metaData[$meta][$language->code] ?? "";
                if ($meta == "slug") {
                    $slugPartsCoded = [];
                    $slugParts = explode("-", $slug);
                    foreach ($slugParts ?? [] as $slug) {
                        $slugPartsCoded[] = str_slug($metaData[$slug][$language->code] ?? $collection->$slug);
                    }
                    $meta_value = implode("-", $slugPartsCoded);
                }
                $collection->metaData()->updateOrCreate([
                    'meta_name' => $meta,
                    'language'  => $language->code,
                ], [
                    'meta_value' => $meta_value,
                ]);
            }
        }
    }

    public function handleImages($collection)
    {



        if (!method_exists($collection, "images")) {
            return;
        }
        $x = 0;
        list($urls, $main, $id) = [request('image_url'), request('image_main'), request('image_id')];

        $type = "image";

        $imagesInFiles = $collection->images()->get()->pluck('id')->toArray();

        if (!is_array($id)) return;

        foreach (array_diff($imagesInFiles, $id) as $fileID) {
            $file = File::find($fileID);

            $imageSizes = config("app.imageSize.".$file->owner, null);

            if ($imageSizes) {
                foreach ($imageSizes as $imageSize) {
                    $path = implode("/", ["public", config("app.uploadFile.{$file->owner}"), $imageSize, $file->filePath]);
                    \Storage::delete($path);
                }
            } else {
                $path = implode("/", ["public", config("app.uploadFile.{$file->owner}"), $file->filePath]);
                \Storage::delete($path);
            }
            $file->delete();
//            unlink(storage_path(str_replace('/storage', 'app/public', $file->filePath)));
        }

        do {
            $file = File::findOrFail($id[$x]);
            $file->main = $main[$x] ?? 0;
            $file->owner_id = $collection->id;
            $file->fileType = $type;
            $file->save();
            $x++;
        } while ($urls[$x] ?? false);
    }
}