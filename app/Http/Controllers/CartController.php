<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;
use App\Mail\SendMail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    function show() {
        return view("cart.show");
    }

    function add(Request $request, $id) {
        $productById = Product::find($id);
        Cart::add(
            [
                'id' => $productById->id, 
                'name' => $productById->name, 
                'qty' => $request->get('quantity'), 
                'price' => $productById->price_new, 
                'options' => 
                    [
                        'code' => $productById->code,
                        'thumb' => $productById->thumb,
                        'color_cart' => session()->get("color"),
                        'size' => $request->get('choose-size'),
                        'slug' => $productById->slug,
                    ]
            ]
        );
        return redirect('gio-hang');
    }

    function remove($rowId) {
        Cart::remove($rowId);
        return redirect('gio-hang');
    }
    
    function destroy() {
        Cart::destroy();
        return redirect('gio-hang');
    }

    function update(Request $request) {
        $carts = $request->get('qty');
        foreach($carts as $rowId => $id) {
            Cart::update($rowId, $id);
        }
        return redirect('gio-hang');
    }

    function checkout() {return view('cart.checkout');}

    function buyStore(Request $request) {
        $request->validate(
            [
                "fullname" => "required|string|min:8|max:255",
                "email" => "required|email|string|max:255",
                "address" => "required|string",
                "phone" => "required|max:10|regex:/^[0-9]+$/"
            ],
            [
                "required" => ":attribute không được bỏ trống!",
                "string" => ":attribute nhập vào phải ở dạng chuỗi ký tự!",
                "min" => ":attribute nhập vào phải có ít nhất :min ký tự!",
                "max" => ":attribute chỉ cho phép nhập tối đa :max ký tự!",
                "email" => ":attribute nhập vào chưa đúng định dạng của email!",
                "regex" => ":attribute chưa đúng định dạng!"

            ],
            [
                "fullname" => "Họ tên",
                "email" => "Email",
                "address" => "Địa chỉ",
                "phone" => "Số điện thoại",
            ]
        );

        $name_empty = [];
        $code_empty = [];
        $avatar_empty = [];
        $color_product_emp = [];
        $qty_empty = [];
        $size_empty = [];
        $total_qty = 0;
        $sub_total_empty = [];
        $price_empty = [];
        foreach (Cart::content() as $row) {
            $name_empty[] = $row->name;
            $size_empty[] = $row->options->size;
            $color_product_emp[] = $row->options->color_cart;
            $code_empty[] = $row->options->code;
            $avatar_empty[] = $row->options->thumb;
            $qty_empty[] = $row->qty;
            $price_empty[] = $row->price;
            $sub_total_empty[] = $row->total;
            $total_qty += $row->qty;
        }
        $size = implode(",", $size_empty);
        $colorProduct = implode(",", $color_product_emp);
        $name_product = implode(",", $name_empty);
        $code_product = implode(",", $code_empty);
        $thumb = implode(",", $avatar_empty);
        $qty = implode(",",  $qty_empty);
        $price = implode(",",  $price_empty);
        $sub_total_price = implode(",", $sub_total_empty);
        $total_price = Cart::total();
        $name_customer = $request->input('fullname');
        $email_customer = $request->input('email');
        $address_customer = $request->input('address');
        $phone_customer = $request->input('phone');
        $note_customer = $request->input('note');
        $payment = $request->input('payment');
        $code_r = Str::random(3);
        $string_random = Str::upper($code_r);
        $code_order = "M#".$string_random;
        Order::create(
            [
                'order_code' => $code_order,
                'fullname' => $name_customer,
                'email' => $email_customer,
                'address' => $address_customer,
                'phone' => $phone_customer,
                'note' => $note_customer,
                'name_product' => $name_product,
                'code_product' => $code_product,
                'thumb' => $thumb,
                'qty' => $qty,
                'price' => $price,
                'total_price' => $total_price,
                'total_qty' => $total_qty,
                'sub_total_price' => $sub_total_price,
                'color_product' => $colorProduct,
                'payment' => $payment,
                'size' => $size,
            ]
        );
        $data = [
            "code_order" => $code_order,
            "fullname" => $name_customer,
            "address" => $address_customer,
            "email" => $email_customer,
            "phone" => $phone_customer,
            "name_product" => $name_empty,
            "price" => $price_empty,
            "qty" => $qty_empty,
            "sub_total" => $sub_total_empty,
            "total" => $total_price,
            "time_now" => Carbon::now()->format('d/m/Y m:h:s')
        ];
        Mail::to($email_customer)->send(new SendMail($data));
        session(
            [
                "name_empty" => $name_empty,
                "color_product" => $color_product_emp,
                "code_order" => $code_order,
                "qty_empty" => $qty_empty,
                "price_empty" => $price_empty,
                "sub_total_empty" => $sub_total_empty,
                "total_price" => $total_price,
                "name_customer" => $name_customer,
                "email_customer" => $email_customer,
                "address_customer" => $address_customer,
                "phone_customer" => $phone_customer,
                "size" => $size_empty,
            ]
        );
        Cart::destroy();
        return redirect("hoa-don-khach-hang");
    }

    function order_show(Request $request) {  
        $name_empty = $request->session()->get("name_empty");
        $qty_empty = $request->session()->get("qty_empty");
        $code_order = $request->session()->get("code_order");
        $price_empty = $request->session()->get("price_empty");
        $sub_total_empty = $request->session()->get("sub_total_empty");
        $total_price = $request->session()->get("total_price");
        $name_customer = $request->session()->get("name_customer");
        $email_customer = $request->session()->get("email_customer");
        $address_customer = $request->session()->get("address_customer");
        $phone_customer = $request->session()->get("phone_customer");
        $color_product = $request->session()->get("color_product");
        $size = $request->session()->get("size");
        return view("cart.order", compact("name_empty", "qty_empty", "price_empty", "sub_total_empty", "total_price", "name_customer", "email_customer", "address_customer", "phone_customer", "code_order", "color_product", "size"));
    }

    function colorAjax(Request $request) {
        $img_color_1 = $request->input('imgColor1');
        $img_color_2 = $request->input('imgColor2');
        $img_color_3 = $request->input('imgColor3');
        if(!empty($img_color_1)){
            session([
                'color' => $img_color_1,
            ]);
        }
        if(!empty($img_color_2)){
            session([
                'color' => $img_color_2,
            ]);
        }
        if(!empty($img_color_3)){
            session([
                'color' => $img_color_3,
            ]);
        }
    }

    function updateAjax(Request $request) {
        $qty = $request->qty;
        $rowId = $request->rowid;
        Cart::update($rowId, $qty);
    }
}
