<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('photos')->orderBy('created_at','desc')->paginate(15);
        return view('admin.products.index', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view('admin.products.create', compact([ 'brands']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateSKU()
    {
        $number = mt_rand(100000,9999999999);
        if($this->checkSKU($number)) {
            return $this->generateSKU();
        }
        return (string)$number;
    }

    public function checkSKU($number)
    {
        return Product::where('sku', $number)->exists();
    }
    public function store(ProductCreateRequest $request)
    {

        $product = new Product();

        $attributes = explode(',',$request->input('selected_attributes')[0]);
        $photos = explode(',',$request->input('photo_id')[0]);

        $product->title = $request->title;
        $product->sku = $this->generateSKU();
        $product->slug = make_slug($request->slug);
        $product->status = $request->status;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;
        $product->brand_id = $request->brand_id;
        $product->user_id = 1;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_desc;
        $product->meta_keywords = $request->meta_keywords;

        $product->save();

        $product->categories()->sync($request->category_id);
        $product->attributesValue()->sync($attributes);
        $product->photos()->sync($photos);

        Session::flash('created','محصول مورد نظر با موفقیت به سیستم اضافه شد');
        return redirect(route('products.index'));

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
        $product = Product::with('categories','attributesValue','photos')
            ->where('id', $id)
            ->first();
        $brands = Brand::all();
        return view('admin.products.edit', compact(['product', 'brands']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $attributes = explode(',',$request->input('selected_attributes')[0]);
        $photos = explode(',',$request->input('photo_id')[0]);

        $product->title = $request->title;
        $product->slug = make_slug($request->slug);
        $product->status = $request->status;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;
        $product->brand_id = $request->brand_id;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_desc;
        $product->meta_keywords = $request->meta_keywords;

        $product->save();

        $product->categories()->sync($request->category_id);
        $product->attributesValue()->sync($attributes);
        $product->photos()->sync($photos);

        Session::flash('info','محصول با موفقیت ویرایش شد');
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Session::flash('error','محصول به زباله دان منتقل شد');
        return redirect(route('products.index'));
    }

    public function trashIndex()
    {
        $products = Product::with('photos')->onlyTrashed()->get();
        return view('admin.products.trash', compact(['products']));
    }

    public function trashRestore(Request $request)
    {
       $product = Product::onlyTrashed()->where('id', $request->restore_id)->restore();
       Session::flash('info','محصول با موفقیت بازگردانی شد');
       return redirect(route('products.trash.index'));
    }

    public function trashForceDelete(Request $request)
    {
        $product = Product::onlyTrashed()->where('id', $request->forceDelete_id)->forceDelete();
        Session::flash('error','محصول برای همیشه حذف شد');
        return redirect(route('products.trash.index'));
    }
}
