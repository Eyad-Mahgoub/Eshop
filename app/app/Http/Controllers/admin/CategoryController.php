<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        // dd($request->all(), $data);

        if ($request->hasfile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/', $filename);
            $data['image'] = $filename;
        }

        $data['status'] = $request->boolean('status');
        $data['popular'] = $request->boolean('popular');

        Category::create($data);

        Cache::put('featcats', Category::where('status', 0)->where('popular', 1)->take(15)->get());

        return redirect('/category')->with('message', __('admin/categories.success'));
    }

    public function edit(Category $category)
    {
        if (!$category) return redirect()->back()->with('problem', __('admin/categories.delfail'));
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::find($request->id);

        // dd($data);

        $data['status'] = $request->boolean('status');
        $data['popular'] = $request->boolean('popular');


        if ($request->hasfile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/', $filename);
            $data['image'] = $filename;
        }

        $category->update($data);

        Cache::put('featcats', Category::where('status', 0)->where('popular', 1)->take(15)->get());

        return redirect('/category')->with('message', __('admin/categories.editsuccess'));
    }

    public function destroy(Category $category)
    {
        if (! $category) return redirect()->back()->with('problem', __('admin/categories.delfail'));

        $category->delete();
        Cache::put('featcats', Category::where('status', 0)->where('popular', 1)->take(15)->get());

        return redirect()->back()->with('message', __('admin/categories.delsuccess'));
    }
}
