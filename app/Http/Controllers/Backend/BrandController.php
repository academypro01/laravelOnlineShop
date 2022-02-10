<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(15);
        return view('admin.brands.index', compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $brand = new Brand();

        $brand->title = $request->title;
        $brand->description = $request->description;
        $brand->photo_id = $request->photo_id;

        $brand->save();

        Session::flash('created', "برند $request->title با موفقیت ساخته شد.");
        return redirect(route('brands.index'));
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
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact(['brand']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->title = $request->title;
        $brand->description = $request->description;
        $brand->photo_id = $request->photo_id;

        $brand->save();

        Session::flash('info', "برند $request->title با موفقیت ویرایش شد.");
        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        unlink(public_path() . $brand->photo->path);
        $photo = Photo::findOrFail($brand->photo->id);
        $photo->delete();
        $brand->delete();
        Session::flash('error', "برند با موفقیت حذف شد");
        return redirect(route('brands.index'));
    }
}
