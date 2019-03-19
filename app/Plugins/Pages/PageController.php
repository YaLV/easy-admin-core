<?php

namespace App\Plugins\Pages;


use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\Pages\Model\Page;
use App\Plugins\Pages\Model\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends AdminController
{
    use General;
    use \App\Plugins\Pages\Functions\Page;

    public $namespace = __NAMESPACE__;

    public function index()
    {
        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Pages',
                'list'         => Page::withTrashed()->with('metaData')->paginate(20),
                'idField'      => 'title',
                'destroyName'  => 'Page',
            ]);
    }

    public function add()
    {
        return view('admin.elements.tabForm', ['formElements' => $this->choose(), 'content' => new Page()]);
    }

    public function view($id)
    {
        return redirect(route('components', $id));
    }

    public function edit($id)
    {
        $page = Page::withTrashed()->findOrFail($id);

        return view('admin.elements.tabForm', ['formElements' => $this->choose(), 'content' => $page]);
    }

    public function store(Request $request, $id = false)
    {
        if (!$id) {
            try {
                DB::beginTransaction();
                $hasChildren = $this->getTemplate(Template::find(request('template'))->template)->children ?? null;
                $page = Page::create([
                    'template'    => request('template'),
                    'title'       => request('title'),
                    'homepage'    => request('homepage') ? 1 : null,
                    'hasChildren' => $hasChildren,
                ]);
                $this->handleMetas($page, ['name', 'slug']);

                $this->addComponents($page);

                DB::commit();

                return redirect()->route('components', $page->id);
            } catch (\PDOException $e) {
                DB::rollBack();

                dd($e->getMessage());

                return redirect()->back();
            }
        } else {
            try {
                DB::beginTransaction();

                if(request('homepage')) {
                    Page::where('homepage', 1)->update(['homepage' => null]);
                }

                /** @var Page $page */
                $page = Page::updateOrCreate(['id' => $id], [
                    'title'       => request('title'),
                    'homepage'    => request('homepage') ? 1 : null,
                ]);
                $this->handleMetas($page, ['name', 'slug']);
                DB::commit();
                $page->forgetMeta();

                return redirect()->route('pages.list');
            } catch (\PDOException $e) {
                DB::rollBack();

                dd($e->getMessage());

                return redirect()->back();
            }
        }
    }
}