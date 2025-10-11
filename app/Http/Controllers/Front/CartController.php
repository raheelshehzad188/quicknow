<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Api;
use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        if (Cart::add($request->id, $request->qty ?? 1)) {
            return response()->json([
                'msg'=>'Product Added to Cart',
                'msg_type'=>'success',
                'qty'=> Cart::qty()
            ]);
        } else {
            return response()->json([
                'msg'=>'Item out of stock!',
                'msg_type'=>'danger',
            ]);
        }
    }

    public function remove($id)
    {
            $cart = Session::get('cart', []);
            foreach($cart['items'] as $k=> $v)
            {
                if($v['id'] == $id)
                {
                    unset($cart['items'][$k]);
                }
            }
        Session::put('cart', $cart);

    return redirect('/checkout')->with([
                'msg'=>'Cart item removed successfully',
                'msg_type'=>'success',
            ]);

    }

    public function increment(Request $request)
    {
        if (Cart::increase($request->id)) {
            return Api::setResponse('cart', Session::get('cart'));
        } else {
            return Api::setError('Item out of stock!');
        }
    }

    public function decrement(Request $request)
    {
        Cart::decrease($request->id);
        return Api::setResponse('cart', Session::get('cart'));
    }

    public function clear()
    {
        Session::forget('cart');
        Session::forget('coupen');
        Session::forget('check');
        return redirect()->back();
    }

    public function getCartData()
    {
        $cart = Session::get('cart', []);
        $cartData = [
            'qty' => 0,
            'amount' => 0,
            'items' => []
        ];

        if (!empty($cart) && isset($cart['items'])) {
            $cartData['qty'] = $cart['qty'] ?? 0;
            $cartData['amount'] = $cart['amount'] ?? 0;
            
            foreach ($cart['items'] as $item) {
                $product = \App\Models\Admins\Product::find($item['id']);
                if ($product) {
                    $cartData['items'][] = [
                        'id' => $item['id'],
                        'name' => $product->product_name,
                        'price' => $product->discount_price,
                        'qty' => $item['qty'],
                        'image' => !empty($product->image_one) ? custom_assets($product->image_one) : '/theme2/img/solo.webp'
                    ];
                }
            }
        }

        return response()->json(['cart' => $cartData]);
    }
}
