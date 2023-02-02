<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    function index(Request $request) 
    {
        $sliders = Slider::all();
        $hotProduct = Product::where('category_product', 'hot_product')->paginate(20);
        $saleGoodProduct = Product::where('category_product', 'sales_good_product')->paginate(20);
        $request->session()->forget(["name_empty", "qty_empty", "price_empty", "sub_total_empty", "total_price", "name_customer", "email_customer", "address_customer", "phone_customer", "code_order", "color_product", "color", "size", "rating"]);
        return view('home.index', compact('hotProduct', 'saleGoodProduct', 'sliders'));
    }

    function skirt(Request $request) 
    {
        $filter_price_asc = $request->input('filter');
        if($filter_price_asc == 'asc') {
            $skirtProduct = Product::where('category_product', 'skirt')->orderBy("price_new", "desc")->paginate(30);
            return view('product.skirt', compact('skirtProduct'));
        }
        if($filter_price_asc == 'desc') {
            $skirtProduct = Product::where('category_product', 'skirt')->orderBy("price_new", "asc")->paginate(30);
            return view('product.skirt', compact('skirtProduct'));
        }
        $skirtProduct = Product::where('category_product', 'skirt')->paginate(30);
        // return $skirtProduct;
        return view('product.skirt', compact('skirtProduct'));
    }
    
    function shirt(Request $request)
    {
        $filter_price_asc = $request->input('filter');
        if($filter_price_asc == 'asc') {
            $shirtProduct = Product::where('category_product', 'shirt')->orderBy("price_new", "desc")->paginate(30);
            return view('product.shirt', compact('shirtProduct'));
        }
        if($filter_price_asc == 'desc') {
            $shirtProduct = Product::where('category_product', 'shirt')->orderBy("price_new", "asc")->paginate(30);
            return view('product.shirt', compact('shirtProduct'));
        }
        $shirtProduct = Product::where('category_product', 'shirt')->paginate(30);
        return view('product.shirt', compact('shirtProduct'));
    }

    function trouser(Request $request)
    {
        $filter_price_asc = $request->input('filter');
        if($filter_price_asc == 'asc') {
            $trouserProduct = Product::where('category_product', 'trouser')->orderBy("price_new", "desc")->paginate(30);
            return view('product.trouser', compact('trouserProduct'));
        }
        if($filter_price_asc == 'desc') {
            $trouserProduct = Product::where('category_product', 'trouser')->orderBy("price_new", "asc")->paginate(30);
            return view('product.trouser', compact('trouserProduct'));
        }
        $trouserProduct = Product::where('category_product', 'trouser')->paginate(30);
        return view('product.trouser', compact('trouserProduct'));
    }

    function detail($slug) 
    {
        $detailProduct = Product::where('slug', $slug)->get()[0];
        $rating = round(Comment::where("product_id", $detailProduct->id)->avg("rating"));
        Product::where("id", $detailProduct->id)->update(["star_votes"=>$rating]);
        $id = $detailProduct->id;
        $comment = Comment::paginate(50);
        $comment_emp = [];
        foreach($comment as $item) {
            if($item->product_id == $id) {
                $comment_emp[] = $item;
            } 
        }
        return view('product.detail', compact('detailProduct', 'rating', 'comment', 'comment_emp'));
    }
}
