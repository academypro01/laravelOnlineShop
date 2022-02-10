<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(20);
        return view('admin.coupons.index', compact(['coupons']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $coupon = new Coupon();

        $coupon->title = $request->title;
        $coupon->code = $request->code;
        $coupon->price = $request->price;
        $coupon->status = $request->status;

        $coupon->save();

        Session::flash('created','کدتفیف با موفقیت ثبت شد');
        return redirect(route('coupons.index'));
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
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact(['coupon']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponUpdateRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->title = $request->title;
        $coupon->code = $request->code;
        $coupon->price = $request->price;
        $coupon->status = $request->status;
        $coupon->save();

        Session::flash('info','کدتخفیف با موفقیت بروزرسانی شد');
        return redirect(route('coupons.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        Session::flash('error','کدتخفیف با موفقیت حذف شد');
        return redirect(route('coupons.index'));
    }
}
