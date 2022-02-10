<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function apiIndex()
    {
        $categories = Category::with('childrenRecursive')
            ->orderBy('created_at','desc')
            ->where('parent_id', null)
            ->get();

        $response = [
          'categories' => $categories
        ];

        return response()->json($response, 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('childrenRecursive')
            ->orderBy('created_at','desc')
            ->where('parent_id', null)
            ->paginate(15);

        return view('admin.categories.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', null)
            ->get();
        return view('admin.categories.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();

        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->meta_desc = $request->meta_desc;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;

        $category->save();
        Session::flash('created',"دسته بندی: $request->name ، با موفقیت اضافه شد.");
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selected_category = Category::findOrFail($id);
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', null)
            ->get();
        return view('admin.categories.edit', compact(['selected_category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->meta_desc = $request->meta_desc;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;

        $category->save();

        Session::flash('info', "دسته بندی: $request->name ، با موفقیت به روز رسانی شد.");

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::with('childrenRecursive')
            ->where('id', $id)
            ->first();
        if(count($category->childrenRecursive) > 0) {
            Session::flash('error',"دسته بندی: $category->name دارای زیر دسته است و حذف آن امکان پذیر نیست.");
            return redirect(route('categories.index'));
        }

        Session::flash('info',"دسته بندی با موفقیت حذف شد");
        $category->delete();
        return redirect(route('categories.index'));
    }
}
