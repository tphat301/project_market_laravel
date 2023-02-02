<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active'=>'order']);
            return $next($request);
        });
    }

    public function show(Request $request) {
        $keyword = "";
        $action = [
            "is_handle" => "Đang xử lý",
            "is_transport" => "Đang vận chuyển",
            "is_success" => "Thành công",
            "order_cancel" => "Hủy đơn hàng", 
        ];
        $state = $request->input('state');
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->paginate(20);
        }
        if($state) {
            if($state == 'all') {
                $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->paginate(20);
            }
            if($state == 'is_handle') {
                $action = [
                    "is_transport" => "Đang vận chuyển",
                    "is_success" => "Thành công",
                    "order_cancel" => "Hủy đơn hàng", 
                ];
                $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->where("status_order", "is_handle")->paginate(20);
            }
            if($state == 'is_transport') {
                $action = [
                    "is_handle" => "Đang xử lý",
                    "is_success" => "Thành công",
                    "order_cancel" => "Hủy đơn hàng", 
                ];
                $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->where("status_order", "is_transport")->paginate(20);
            }
            if($state == 'is_success') {
                $action = [
                    "is_handle" => "Đang xử lý",
                    "is_transport" => "Đang vận chuyển",
                    "order_cancel" => "Hủy đơn hàng",
                ];
                $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->where("status_order", "is_success")->paginate(20);
            }
            if($state == 'order_cancel') {
                $action = [
                    "restore" => "Khôi phục", 
                    "forceDelete" => "Xóa vĩnh viễn", 
                ];
                $orders = Order::onlyTrashed()->where("fullname", "LIKE", "%{$keyword}%")->paginate(20);
            }
            $all_count = Order::count();
            $is_handle_count = Order::where("status_order", "is_handle")->count();
            $is_success_count = Order::where("status_order", "is_success")->count();
            $is_transport_count = Order::where("status_order", "is_transport")->count();
            $order_cancel_count = Order::onlyTrashed()->count();
            $state_count = [$all_count, $is_handle_count, $is_transport_count, $is_success_count, $order_cancel_count];
            return view('admin.order.show', compact('orders', 'action' , 'state_count'));
        }
        $all_count = Order::count();
        $is_handle_count = Order::where("status_order", "is_handle")->count();
        $is_success_count = Order::where("status_order", "is_success")->count();
        $is_transport_count = Order::where("status_order", "is_transport")->count();
        $order_cancel_count = Order::onlyTrashed()->count();
        $state_count = [$all_count, $is_handle_count, $is_transport_count, $is_success_count, $order_cancel_count];
        $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->paginate(20);
        return view('admin.order.show', compact('orders', 'action', 'state_count'));
    }

    public function delete($id) {
        $order = Order::find($id);
        $order->update(['status_order'=>'order_cancel']);
        $order->delete();
        return redirect('admin/order/list')->with('status', 'Hủy đơn hàng thành công');
    }

    public function detail($id) {
        $order_by_id = Order::withTrashed()->find($id);
        $thumb = Order::withTrashed()->select("thumb")->find($id);
        $name_product = Order::withTrashed()->select("name_product")->find($id);
        $qty = Order::withTrashed()->select("qty")->find($id);
        $price = Order::withTrashed()->select("price")->find($id);
        $sub_total_price = Order::withTrashed()->select("sub_total_price")->find($id);
        $color_product = Order::withTrashed()->select("color_product")->find($id);
        $color_product_order = explode(",", $color_product->color_product);
        $sub_total_price_order = explode(",", $sub_total_price->sub_total_price);
        $price_order = explode(",", $price->price);
        $name = explode(",", $name_product->name_product);
        $qty_order = explode(",", $qty->qty);
        $thumb_order = explode(",", $thumb->thumb);
        return view('admin.order.detail', compact('order_by_id', 'thumb_order', 'name', 'qty_order', 'price_order', 'sub_total_price_order', 'color_product_order'));
    }

    public function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == 'is_handle') {
                    Order::whereIn('id', $list_check)->update(['status_order'=> 'is_handle']);
                    return redirect('admin/order/list')->with('status', 'Cập nhật trạng thái đơn hàng thành công');
                }
                if($act == 'is_transport') {
                    Order::whereIn('id', $list_check)->update(['status_order'=> 'is_transport']);
                    return redirect('admin/order/list')->with('status', 'Cập nhật trạng thái đơn hàng thành công');
                }
                if($act == 'is_success') {
                    Order::whereIn('id', $list_check)->update(['status_order'=> 'is_success']);
                    return redirect('admin/order/list')->with('status', 'Cập nhật trạng thái đơn hàng thành công');
                }
                if($act == 'order_cancel') {
                    Order::whereIn('id', $list_check)->update(['status_order'=>'order_cancel']);
                    Order::destroy($list_check);
                    return redirect('admin/order/list')->with('status', 'Hủy đơn hàng thành công');
                }
                if($act == 'restore') {
                    Order::onlyTrashed()->update(['status_order'=>'is_handle']);
                    Order::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/order/list')->with('status', 'Khôi phục đơn hàng thành công');
                }
                if($act == 'forceDelete') {
                    Order::withTrashed()->whereIn('id', $list_check)->forceDelete();
                    return redirect('admin/order/list')->with('status', 'Xóa vĩnh viễn đơn hàng thành công');
                }
                return redirect('admin/order/list')->with('error', 'Vui lòng chọn thao tác để thao tác!');
            }
        } else {
            return redirect('admin/order/list')->with('error', 'Vui lòng chọn bản ghi để thao tác!');
        }
    } 
}
