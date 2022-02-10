<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function verify()
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        if(!$cart) {
            Session::flash('warning', 'سبد خرید شما خالی است');
            return redirect('/');
        }

        $productsId= [];

        foreach ($cart->items as $product) {
            $productsId[$product['item']->id] = ['qty' => $product['qty']];
        }

        $order = new Order();
        $order->amount = $cart->totalPrice;
        $order->user_id = Auth::id();
        $order->status = 1;
        $order->save();

        $order->products()->sync($productsId);
    }
}
