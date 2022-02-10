<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValueRequest;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesValue = AttributeValue::with('attributeGroup')->paginate(15);
        return view('admin.attributesValue.index', compact(['attributesValue']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributesGroup = AttributeGroup::all();
        return view('admin.attributesValue.create', compact(['attributesGroup']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeValueRequest $request)
    {
        $attributeValue = new AttributeValue();

        $attributeValue->title = $request->title;
        $attributeValue->attributeGroup_id = $request->attributeGroup_id;

        $attributeValue->save();

        Session::flash('created', "مقدار $request->title با موفقیت اضافه شد.");
        return redirect(route('attributesValue.index'));
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
        $attributeValue = AttributeValue::with('attributeGroup')
        ->where('id', $id)
        ->first();
        $attributesGroup = AttributeGroup::all();
        return view('admin.attributesValue.edit', compact(['attributeValue', 'attributesGroup']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeValueRequest $request, $id)
    {
        $attributeValue = AttributeValue::findOrFail($id);

        $attributeValue->title = $request->title;
        $attributeValue->attributeGroup_id = $request->attributeGroup_id;

        $attributeValue->save();

        Session::flash('info',"ویژگی $request->title با موفقیت ویرایش شد.");

        return redirect(route('attributesValue.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->delete();
        Session::flash('error','مقدار ویژگی با موفقیت حذف شد');
        return redirect(route('attributesValue.index'));
    }
}
