<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderlist;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function pizzaList(Request $request)
    {
        // logger($request->status);
        // $data=Product::get();
        // return $data;
        if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        } else {

            $data = Product::orderBy('created_at', 'desc')->get();

        }

        return response()->json($data, 200);

    }

    //increase view count
    public function increaseViewCount(Request $request)
    {
        $data = Product::where('id', $request->product_id)->first();
        logger($data);
        $view_count = [
            'view_count' => $data->view_count + 1,
        ];
        Product::where('id', $request->product_id)->update($view_count);

    }
    //add to Cart
    public function addToCart(Request $request)
    {
        // logger($request->all());
        $data = $this->getData($request);
        Cart::create($data);
        $response = [
            'message' => 'Complete add ',
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }

    //remove cart list
    public function removeAllCart()
    {
        $data = Cart::where('user_id', Auth::user()->id)->delete();
        dd($data);

    }

    public function removeCart(Request $request)
    {

        Cart::where('id', $request->cart_id)->delete();
    }

    //add to Orderlist
    public function addOrderList(REQUEST $request)
    {

        $total = 0;
        foreach ($request->all() as $item) {
            $data = Orderlist::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            $total += $data->total;
        };
        Cart::where('user_id', Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total + 3000,
            'order_code' => $data->order_code,
        ]);
        return response()->json([
            'message' => 'succuess',
            'status' => 'true',
        ], 200);
    }

    private function getData($request)
    {
        return [
            'user_id' => $request->user,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}