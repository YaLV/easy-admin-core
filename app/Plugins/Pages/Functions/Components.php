<?php

namespace App\Plugins\Pages\Functions;

use App\Plugins\Pages\Model\PageComponent;

trait Components
{

    public function getList()
    {
        return [
            ['field' => 'component_name', 'label' => 'Component'],
            ['field' => 'buttons', 'label' => '', 'buttons' => ['edit', 'delete']],
        ];
    }

    public function form($template)
    {

        $componentClassName = "App\\Components\\$template";
        $componentClass = new $componentClassName;

        if (method_exists($componentClass, 'form')) {
            return $componentClass->form();
        } else {
            return null;
        }
    }

    public function getDisabledItems($components)
    {
        $disable = [];
        foreach ($components as $component) {
            $className = "App\\Components\\{$component->component_slug}";
            $class = new $className;

            if ($class->disableEdit ?? false) {
                $disable[] = $component->id;
            }
        }

        return $disable;
    }

    public function addForm()
    {
        return [
            'data' => [
                'component' => ['type' => 'select', 'label' => 'Component', 'options' => $this->getComponents()],
            ],
        ];
    }

    public function getComponents()
    {
        $options = [];
        $components = glob(app_path("Components") . "/*.php");

        foreach ($components as $component) {
            $component = explode(".", basename($component));
            $class = "App\\Components\\{$component[0]}";
            $componentClass = new $class;
            $options[] = (object)['id' => class_basename($componentClass), 'name' => $componentClass->componentName];
        }

        return $options;
    }

    public function getContents($contents)
    {
        $meta_value = [];
        foreach ($contents ?? [] as $content) {
            $language = $content->language;
            $meta_value = [];
            foreach ($content->meta_value as $key => $value) {
                if ($key == 'image') {
                    $images = $value;
                    continue;
                }
                $meta_value[$key][$language] = $value;
            }
        }

        return new PageComponentFactory($meta_value, $images ?? []);
    }

    public function getEditName($id)
    {

        if ($id == request()->route('page')) {
            return \App\Plugins\Pages\Model\Page::find($id)->title;
        }

        return PageComponent::find($id)->component_name;
    }

    public function createMetaData()
    {
        $metaData = ['data' => []];

        $savedData = request()->all();

        $image = $savedData['image_id'] ?? null;

        foreach (request()->all() as $reqKey => $reqData) {
            if (in_array($reqKey, ['pageimage', 'image_url', 'image_id', '_token', 'image_main', 'pageimage1', 'pageimage2', 'pageimage3'])) continue;
            foreach (languages() as $lang) {
                if (is_array($reqData)) {
                    $metaData['data'][$lang->code]['image'] = $image;
                    $metaData['data'][$lang->code] = array_merge(($metaData['data'][$lang->code] ?? []), [$reqKey => $reqData[$lang->code]]);
                } else {
                    $metaData['data'][$lang->code][$reqKey] = $reqData;
                }
            }
        }

        return $metaData;
    }
}