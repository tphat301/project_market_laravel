<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(["module_active" => "dashboard"]);
            return $next($request);
        });
    }

    public function show () 
    {
        $orders = Order::paginate(50);
        $total_price_order_empty = [];
        $total_price_order = Order::get("total_price");
        foreach($total_price_order as $item) {
            $total_price_order_empty[] = $item->total_price;
        }
        $total_price_sale = array_sum($total_price_order_empty);
        $total_qty_order_empty = [];
        $total_qty_order = Order::get("total_qty");
        foreach($total_qty_order as $item) {
            $total_qty_order_empty[] = $item->total_qty;
        }
        $qty_product_empty = [];
        $qty_product = Product::get("qty");
        foreach($qty_product as $item) {
            $qty_product_empty[] = $item->qty;
        }
        $qty_product_of_system = array_sum($qty_product_empty);
        $total_qty_sale = array_sum($total_qty_order_empty);
        $number_trash_order = Order::onlyTrashed()->count();
        $number_success_order = Order::where("status_order", "is_success")->count();
        $number_trasport_order = Order::where("status_order", "is_transport")->count();
        $number_isHandle_order = Order::where("status_order", "is_handle")->count();
        return view("admin.dashboard.show", compact("orders", "number_trash_order", "number_success_order", "number_trasport_order", "number_isHandle_order", "total_price_sale", "total_qty_sale", "qty_product_of_system"));
    }
}
