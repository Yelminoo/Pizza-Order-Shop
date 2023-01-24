<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderlist;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    function list() {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->when(request('key'), function ($query) {
                $query->orWhere('users.name', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.order_code', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.total_price', 'like', '%' . request('key') . '%')

                ;
            })
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.order.list', compact('order'));

    }

    //filter status
    public function filterList(Request $request)
    {
        $order = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->when(request('key'), function ($query) {
                $query->orWhere('users.name', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.order_code', 'like', '%' . request('key') . '%')
                    ->orWhere('orders.total_price', 'like', '%' . request('key') . '%')

                ;
            });

        if ($request->status == null) {
            $order = $order

                ->orderBy('id', 'desc')
                ->get();
        } else {
            $order = $order
                ->where('orders.status', $request->status)
                ->orderBy('id', 'desc')
                ->get();
        };

        return view('admin.order.list', compact('order'));

    }

    public function updateStatus(Request $request)
    {

        Order::where('id', $request->orderId)->update(['status' => $request->status]);

    }

    public function details($orderCode)
    {
        $total = Order::select('total_price')->where('order_code', $orderCode)->get();

        $order = Orderlist::select('orderlists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
            ->where('orderlists.order_code', $orderCode)
            ->leftJoin('users', 'users.id', 'orderlists.user_id')
            ->leftJoin('products', 'products.id', 'orderlists.product_id')
            ->get();
        return view('admin.order.orderList', compact('order', 'total'));
    }
}