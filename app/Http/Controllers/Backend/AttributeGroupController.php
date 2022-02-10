<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeGroupRequest;
use App\Models\AttributeGroup;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeGroupController extends Controller
{
    public function apiIndex(Request $request)
    {
        $categories = $request->all();
        $attributes = AttributeGroup::with('attributesValue','categories')
            ->whereHas('categories', function ($q) use ($categories){
                $q->whereIn('categories.id', $categories);
            })
            ->get();
        $response = [
            'attributes' => $attributes
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
        $attributesGroup = AttributeGroup::orderBy('created_at','desc')->paginate(15);
        return view('admin.attributesGroup.index', compact(['attributesGroup']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributesGroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeGroupRequest $request)
    {
        $attributeGroup = new AttributeGroup();

        $attributeGroup->title = $request->title;
        $attributeGroup->type = $request->type;

        $attributeGroup->save();

        Session::flash('created', "ویژگی: $request->title ، با موفقیت اضافه شد.");

        return redirect(route('attributesGroup.index'));
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
        $attributeGroup = AttributeGroup::findOrFail($id);
        return view('admin.attributesGroup.edit', compact(['attributeGroup']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeGroupRequest $request, $id)
    {
        $attributeGroup = AttributeGroup::findOrFail($id);

        $attributeGroup->title = $request->title;
        $attributeGroup->type = $request->type;

        $attributeGroup->save();

        Session::flash('info', "ویژگی: $request->title ، با موفقیت بروزرسانی شد.");

        return redirect(route('attributesGroup.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeGroup = AttributeGroup::findOrFail($id);
        $attributeGroup->delete();
        Session::flash('error', "ویژگی با موفقیت حذف شد.");
        return redirect(route('attributesGroup.index'));
    }
}
