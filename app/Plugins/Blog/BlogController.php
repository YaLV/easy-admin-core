<?php

namespace App\Plugins\Blog;


use App\Functions\General;
use App\Plugins\Admin\AdminController;
use App\Plugins\Blog\Model\Blog;
use App\Plugins\Blog\Model\BlogCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Plugins\Blog\Functions\Blog as BlogFunctions;

class BlogController extends AdminController
{
    private $list;
    private $editId;

    use BlogFunctions;
    use General;

    public function indexPosts()
    {
        $this->list = 'posts';

        return $this->index();
    }

    public function indexCategories()
    {
        $this->list = 'categories';

        return $this->index();
    }

    public function index()
    {
        $list = $this->list;
        $search = request()->route('search') ?? false;

        $cr = explode(".", Route::currentRouteName());

        if (!$search && ($cr[1] ?? false) == 'search') {
            return redirect()->route($cr[0] . ".list");
        }

        return view('admin.elements.table',
            [
                'tableHeaders' => $this->getList($list),
                'header'       => ucfirst($list),
                'list'         => $this->getData($list),
                'idField'      => 'name',
                'destroyName'  => ucfirst($list),
            ]);
    }

    public function addPosts()
    {
        $this->list = 'posts';

        return $this->add();
    }

    public function addCategories()
    {
        $this->list = 'categories';

        return $this->add();
    }

    public function editCategories($id)
    {
        $this->list = 'categories';
        $this->editId = $id;

        return $this->add();
    }

    public function editPosts($id)
    {
        $this->list = 'posts';
        $this->editId = $id;

        return $this->add();
    }

    public function add()
    {
        $list = $this->list;
        $id = $this->editId;
        if ($list == 'posts') {
            return view('admin.elements.tabForm', ['formElements' => $this->form($list), 'content' => $id ? Blog::findOrFail($id) : new Blog]);
        }

        return view('admin.elements.tabForm', ['formElements' => $this->form($list), 'content' => $id ? BlogCategories::findOrFail($id) : new BlogCategories]);
    }

    public function storePosts(Request $request, $id = false)
    {
        $request->validate([
            'name.' . config('app.locale') => 'required',
            'slug.' . config('app.locale') => 'required',
            'main_category'                => 'required',
            'content'                      => 'required',
        ]);

        $this->list = 'posts';

        return $this->store($request, $id);
    }

    public function storeCategories(Request $request, $id = false)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $this->list = 'categories';

        return $this->store($request, $id);
    }

    public function store(Request $request, $id = false)
    {

        $route = "blog.list";
        $item = "Post";
        try {
            DB::beginTransaction();
            switch ($this->list) {
                case "posts":

                    $metas = [
                        'name',
                        'slug',
                        'content',
                        'google_keywords',
                        'google_description',
                    ];
                    /** @var Blog $posts */
                    $posts = Blog::updateOrCreate(['id' => $id],
                        [
                            'is_highlighted' => $this->switch(request('is_highlighted')),
                            'main_category'  => request('main_category'),
                        ]);

                    $this->handleMetas($posts, $metas, 'name');
                    $this->handleImages($posts);

                    $categories = array_merge(request(['main_category']), request('extra_categories')??[]);
                    $posts->extra_categories()->sync($categories);
                    $posts->linked_products()->sync(request('linked_products')??[]);
                    $posts->linked_supplier()->sync(request('linked_supplier')??[]);
                    $posts->forgetMeta();
                    $route = 'blog.list';
                    $item = "Post";
                    break;

                case "categories":

                    $metas = [
                        'name',
                        'slug',
                    ];
                    /** @var BlogCategories $category */
                    $category = BlogCategories::updateOrCreate(['id' => $id]);

                    $this->handleMetas($category, $metas, 'name');
                    $route = 'blog.categories.list';
                    $item = "Category";
                    $category->forgetMeta();
                    break;
            }
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            session()->flash("message", ['msg' => $e->getMessage(), 'isError' => true]);

            return redirect()->back()->with(request()->all());
        }

        return redirect(route($route))->with(['message' => ['msg' => "$item Saved"]]);
    }

    public function destroyPost($id)
    {
        $result = Blog::findOrFail($id)->delete();

        $result = ['status' => $result, "message" => $result ? "Post Deleted" : "Error Deleting Post"];

        return $result;
    }

    public function destroyCategory(BlogCategories $id)
    {
        if ($id->mainPost()->count()) {
            return ['status' => false, "message" => "Error Deleting Post Category, it is set as main category for some posts"];
        }
        try {
            DB::beginTransaction();
            $id->posts()->detach();
            $id->delete();
            DB::commit();
            $result = true;
        } catch (\PDOException $e) {
            $result = false;
        }
        $result = ['status' => $result, "message" => $result ? "Post Category Deleted" : "Error Deleting Post Category"];

        return $result;
    }
}