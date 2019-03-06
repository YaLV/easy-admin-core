<?php
/**
 * Created by PhpStorm.
 * User: ya
 * Date: 3/5/19
 * Time: 10:17 AM
 */

namespace App\Plugins\Translations\Functions;


trait Translations
{
    public function getList()
    {
        return [
            ['field' => 'key', "label" => 'Translation Key'],
            ['field' => 'name', 'label' => 'Translation', 'translate' => 'translations', 'key' => 'key', "class" => "transVal"],
            ['field' => 'params_list', 'label' => 'Available Parameters'],
        ];
    }

    private function iterate($dir, $findString): array
    {
        $matches = [];
        $returnContent = [];
        $finder = new \DirectoryIterator($dir);
        foreach ($finder as $content) {
            if ($content->isDot()) continue;
            if ($content->isDir()) {
                $returnContent = array_merge($returnContent, $this->iterate($dir . "/" . $content->getFilename(), $findString));
            } elseif ($content->isFile()) {
                preg_match_all($findString, file_get_contents($dir . "/" . $content->getFilename()), $matches);
                foreach($matches[1] as $mid => $match) {
                    preg_match_all("/['\"](\w*)[\"'] =>/", $matches[2][$mid], $params);
                    $returnContent[] = [
                        'key' => $match,
                        'params' => $params[1]??[],
                    ];
                    if($match=='loginToSave') {
//                        dd($matches);
                    }
                }
                //$returnContent = array_merge($returnContent, ['key' => $matches[1] ?? [], 'params' => $params[1]??[]]);
            }
        }

        return $returnContent;
    }

}