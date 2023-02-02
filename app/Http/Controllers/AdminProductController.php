<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active'=>'product']);
            return $next($request);
        });
    }

    function list(Request $request) 
    {
        $keyword = "";
        $status = $request->input('status');
        $act = ['delete'=>'Xóa tạm thời'];
        if($status == 'trash')
        {
            $act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn',
            ];
            $products = Product::onlyTrashed()->where("name", "LIKE", "%{$keyword}%")->paginate(100);
        } else {
            if($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(100);
        }
        $countProductActive = Product::count();
        $countProductTrash = Product::onlyTrashed()->count();
        $countProduct = [$countProductActive, $countProductTrash];
        return view('admin.product.list', compact('products', 'countProduct', 'act', 'status'));
    }

    function add() 
    {
        return view('admin.product.add');
    }

    function add_store(Request $request) 
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'min:8', 'max:255'], 
                'fabric_material' => ['required', 'string', 'max:255'],
                'code' => ['required'],
                'trandmake' => ['required', 'max:255'],
                'price_new' => ['required','regex:/^[0-9]+$/', ],
                'color' => ['required', 'string'],
                'desc' => ['required', 'string'],
                'content' => ['required', 'string'],
                'category_product' => ['required',],
                'thumb' => ['required', 'unique:products'], 
                'thumb1' => ['unique:products'], 
                'thumb2' => ['unique:products'], 
                'thumb3' => ['unique:products'], 
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => ':attribute đã tồn tại trên hệ thống',
                'string' => ':attribute phải ở dạng chuỗi ký tự',
                'min' => ':attribute nhập vào phải có ít nhất là :min ký tự',
                'max' => ':attribute chỉ cho phép nhập vào tối đa là :max ký tự',
                'regex:/^[0-9]+$/' => ':attribute phải ở dạng số',
            ], 
            [
                'name' => 'Tên sản phẩm',
                'fabric_material' => 'Chất liệu vải',
                'code' => 'Mã sản của phẩm',
                'trandmake' => 'Thương hiệu của sản phẩm',
                'price_new' => 'Giá mới của sản phẩm',
                'price_old' => 'Giá cũ của sản phẩm',
                'color' => 'Màu của sản phẩm',
                'desc' => 'Mô tả sản phẩm',
                'content' => 'Nội dung sản phẩm',
                'category_product' => 'Danh mục sản phẩm',
                'qty' => 'Số lượng của sản phẩm',
                'thumb' => 'Ảnh đại diện của sản phẩm',
                'thumb1' => 'Ảnh màu 1 của sản phẩm',
                'thumb2' => 'Ảnh màu 2 của sản phẩm',
                'thumb3' => 'Ảnh màu 3 của sản phẩm',
            ]
        );

        // Avatar product
        if($request->has('thumb')) {
            $file = $request->thumb;
            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            $typeAllow = array('jpg', 'jpeg', 'png', 'gif');
            if(!in_array(strtolower($fileType), $typeAllow)) {
                return redirect('admin/product/add')->with('error', 'File không đúng định dạng jpg, jpeg, gif, png');
            } else {
                if($fileSize > 26214400) {
                    return redirect('admin/product/add')->with('error', 'File đã vượt quá 25MB');
                } else {
                    $file->move('public/uploads', $fileName);
                    $thumb = 'public/uploads/'.$fileName;
                }
            }
        } 

        // Image 1 of Product
        if($request->has('thumb1')) {
            $file = $request->thumb1;
            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            $typeAllow = array('jpg', 'jpeg', 'png', 'gif');
            if(!in_array(strtolower($fileType), $typeAllow)) {
                return redirect('admin/product/add')->with('error', 'File không đúng định dạng jpg, jpeg, gif, png');
            } else {
                if($fileSize > 26214400) {
                    return redirect('admin/product/add')->with('error', 'File đã vượt quá 25MB');
                } else {
                    $file->move('public/uploads', $fileName);
                    $thumb1 = 'public/uploads/'.$fileName;
                }
            }
        } else {
            $thumb1 = "";
        }

        // Image 2 of Product
        if($request->has('thumb2')) {
            $file = $request->thumb2;
            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            $typeAllow = array('jpg', 'jpeg', 'png', 'gif');
            if(!in_array(strtolower($fileType), $typeAllow)) {
                return redirect('admin/product/add')->with('error', 'File không đúng định dạng jpg, jpeg, gif, png');
            } else {
                if($fileSize > 26214400) {
                    return redirect('admin/product/add')->with('error', 'File đã vượt quá 25MB');
                } else {
                    $file->move('public/uploads', $fileName);
                    $thumb2 = 'public/uploads/'.$fileName;
                }
            }
        } else {
            $thumb2 = "";
        }

        // Image 3 of Product
        if($request->has('thumb3')) {
            $file = $request->thumb3;
            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            $typeAllow = array('jpg', 'jpeg', 'png', 'gif');
            if(!in_array(strtolower($fileType), $typeAllow)) {
                return redirect('admin/product/add')->with('error', 'File không đúng định dạng jpg, jpeg, gif, png');
            } else {
                if($fileSize > 26214400) {
                    return redirect('admin/product/add')->with('error', 'File đã vượt quá 25MB');
                } else {
                    $file->move('public/uploads', $fileName);
                    $thumb3 = 'public/uploads/'.$fileName;
                }
            }
        } else {
            $thumb3 = "";
        }

        Product::create(
            [
                'name' => $request->name,
                'code' => $request->code,
                'thumb' => $thumb,
                'slug' => Str::slug($request->name),
                'thumb1' => $thumb1,
                'thumb2' => $thumb2,
                'thumb3' => $thumb3,
                'status' => $request->status,
                'category_product' => $request->category_product,
                'color' => $request->color,
                'price_new' => $request->price_new,
                'price_old' => $request->price_old,
                'desc' => $request->desc,
                'content' => $request->content,
                'fabric_material' => $request->fabric_material,
                'trandmake' => $request->trandmake,
                'author' => Auth::user()->name,
                'qty' => $request->qty,
                'S' => $request->S,
                'M' => $request->M,
                'L' => $request->L,
                'XL' => $request->XL,
                'XXL' => $request->XXL,
            ]
        );

        return redirect('admin/product/add')->with('success', 'Thêm sản phẩm thành công');
    }

    function delete($id)
    {
        $product = Product::find($id);
        $product->update(['status' => 'trash']);
        $product->delete();
        return redirect('admin/product/list')->with('success', 'Xóa sản phẩm thành công');
    } 

    function action(Request $request)
    {
        $list_ckeck = $request->input('list_check');
        if($list_ckeck) {
            if(!empty($list_ckeck)) 
            {
                $action = $request->input('act');
                if($action == 'delete') 
                {
                    Product::withTrashed()->whereIn('id', $list_ckeck)->update(['status' => 'trash']);
                    Product::destroy($list_ckeck);
                    return redirect('admin/product/list')->with('success', 'Xóa sản phẩm thành công');
                }
                if($action == 'restore') 
                {
                    Product::withTrashed()->whereIn('id', $list_ckeck)->update(['status' => 'active']);
                    Product::withTrashed()->whereIn('id', $list_ckeck)->restore();
                    return redirect('admin/product/list')->with('success', 'Khôi phục sản phẩm thành công');
                }
                if($action == 'forceDelete') 
                {
                    Product::withTrashed()->whereIn('id', $list_ckeck)->forceDelete();
                    return redirect('admin/product/list')->with('success', 'Xóa vĩnh viễn sản phẩm thành công');
                }
                return redirect('admin/product/list')->with('error', 'Cần chọn thao tác để thực thi thao tác!');
            }
        } else {
            return redirect('admin/product/list')->with('error', 'Thao tác không hợp lệ!');
        }
    }

    function update($id) 
    {
        $product_by_id = Product::find($id);
        return view('admin.product.update', compact('product_by_id'));
    }

    function updateStore(Request $request, $id) 
    {
        $product = Product::where('id', $id);
        $product->update(
            [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'author' => $request->author,
                'price_new' => $request->price_new,
                'qty' => $request->qty,
                'desc' => $request->desc,
                'content' => $request->content,
                'status' => $request->status,
                'S' => $request->S,
                'M' => $request->M,
                'L' => $request->L,
                'XL' => $request->XL,
                'XXL' => $request->XXL,
            ]
        );

        return redirect('admin/product/list')->with('success', 'Cập nhật sản phẩm thành công');
    }
}
