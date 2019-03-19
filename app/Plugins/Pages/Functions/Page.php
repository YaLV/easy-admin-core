<?php

namespace App\Plugins\Pages\Functions;


use App\Plugins\Pages\Model\PageComponent;
use App\Plugins\Pages\Model\Template;

trait Page
{

    public function getList()
    {
        return [
            ['field' => 'title', 'label' => 'Page Title'],
            ['field' => 'templateName', 'label' => 'Template'],
            ['field' => 'buttons', 'label' => '', 'buttons' => ['edit', 'view', 'state', 'delete']],
        ];
    }

    public function choose()
    {
        return [
            [
                'Label' => 'Admin Panel',
                'data' => [
                    'title'    => ['type' => 'text', 'label' => 'Page Title'],
                    (request()->route('id')?"template_name":'template') => (request()->route('id')?['type' => 'text', 'label' => 'Template', 'readonly' => 'readonly']:['type' => 'select', 'options' => $this->getTemplateList(), 'label' => 'Template']),
                    'homepage' => ['type' => 'switch', 'label' => 'Starting page'],
                ],
            ],
            [
                'Label'     => 'Frontend',
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'name' => ['type' => 'text', 'label' => 'Page Name', 'meta' => true, 'class' => 'slugify'],
                    'slug' => ['type' => 'text', 'label' => 'Slug', 'meta' => true, 'class' => 'slug'],
                ],
            ],
        ];
    }

    public function form()
    {
        return [
            [
                'Label'     => 'Display',
                'languages' => languages()->pluck('name', 'code'),
                'data'      => [
                    'name' => ['type' => 'text', 'label' => 'Page Name', 'meta' => true, 'class' => 'slugify'],
                    'slug' => ['type' => 'text', 'label' => 'Slug', 'meta' => true, 'class' => 'slug'],
                ],
            ],
        ];
    }

    public function getTemplateList()
    {
        $templates = [];

        foreach (glob(app_path('Templates/*.php')) as $file) {
            if (is_dir($file)) {
                continue;
            }
            $filename = explode(".", basename($file));
            $className = "App\\Templates\\{$filename[0]}";

            /** @noinspection PhpUndefinedMethodInspection */
            Template::updateOrCreate(['template' => $filename[0]], ['name' => $className::getTemplateName()]);
        }

        return Template::all();
    }

    public function getTemplate($template)
    {
        $templateClassName = "\\App\\Templates\\$template";

        return new $templateClassName;
    }

    public function getEditName($id)
    {
        return \App\Plugins\Pages\Model\Page::find($id)->title;
    }

    public function addComponents($collection)
    {
        $template = $this->getTemplate($collection->templates->template);

        foreach ($template->components() as $oid => $component) {
            $componentClassName = "App\\Components\\$component";
            $componentClass = new $componentClassName;


            PageComponent::create([
                'component_name' => $componentClass->componentName,
                'component_slug' => $component,
                'page_id'        => $collection->id,
                'template_id'    => $collection->template,
                'sequence'       => ++$oid,
            ]);

        }

    }
}