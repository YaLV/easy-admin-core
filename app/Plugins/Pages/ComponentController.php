<?php

namespace App\Plugins\Pages;


use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\Pages\Functions\Components;
use App\Plugins\Pages\Model\Page;
use App\Plugins\Pages\Model\PageComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComponentController extends AdminController
{
    use General;
    use Components;

    public $namespace = __NAMESPACE__;

    public function index()
    {

        $components = Page::find(request('page'))->components;

        return view('admin.elements.table',
            [
                'tableHeaders'  => $this->getList(),
                'header'        => 'Page Components',
                'list'          => $components,
                'idField'       => 'title',
                'destroyName'   => 'Component',
                'disabledItems' => $this->getDisabledItems($components),
            ]);
    }

    public function add()
    {
        return view('admin.elements.form', ['formElements' => $this->addForm(), 'content' => (object)['component' => '']]);
    }

    public function edit($id)
    {

        $component = PageComponent::findOrFail(request('id'));

        $componentContents = $component->metaData;

        $componentContent = $this->getContents($componentContents);

        $form = $this->form($component->component_slug);

        if(!$form) {
            return redirect()->route('components', request('page'));
        }

        return view('admin.elements.tabForm', ['formElements' => $form, 'content' => $componentContent]);
    }

    public function store(Request $request, $id = false)
    {

        if (!request()->route('id')) {
            try {
                DB::beginTransaction();

                $className = "App\\Components\\" . request('component');
                $component = new $className;

                /** @var Page $page */
                $page = Page::findOrFail(request()->route('page'));

                $lastSequence = $page->components()->count();
                $component = $page->components()->create([
                    'template_id'    => $page->template,
                    'component_name' => $component->componentName,
                    'component_slug' => request('component'),
                    'sequence'       => ++$lastSequence,
                ]);

                DB::commit();

                return redirect()->route('components.edit', [request()->route('page'), $component->id]);
            } catch (\PDOException $e) {
                DB::rollBack();

                return redirect()->back();
            }
        }

        try {
            DB::beginTransaction();

            $pc = PageComponent::findOrFail(request()->route('id'));

            $metaData = $this->createMetaData();

            $this->handleMetas($pc, ['data'], false, $metaData);
            $this->handleImages($pc, 'pageimage1');
            $this->handleImages($pc, 'pageimage2');

            DB::commit();

            return redirect()->route('components', request()->route('page'));
        } catch (\PDOException $e) {
            DB::rollBack();

            dd($e->getMessage());

            return redirect()->back();
        }
    }

    public function sort(Page $page)
    {

        $page->components()->update(['sequence' => 1]);
        foreach (explode(",", request('sequence')) as $orderId => $sequenceItem) {
            /** @var PageComponent $component */
            $component = PageComponent::where('id', $sequenceItem)->increment('sequence', $orderId);
        }

        return ['status' => true, 'sequence' => $page->components()->get()->pluck('sequence', 'id'), 'message' => 'Items Reordered'];

    }

    public function destroy($id)
    {
        /** @var PageComponent $pageComponent */
        $pageComponent = PageComponent::findOrFail(request()->route('id'));

        $pageComponent->metaData()->delete();


        $result = $pageComponent->delete();

        $result = ['status' => $result, "message" => $result ? "Component Deleted" : "Error Deleting Component"];

        return $result;
    }
}