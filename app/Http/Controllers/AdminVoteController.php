<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use Illuminate\Http\Request;

class AdminVoteController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active'=>'vote']);
            return $next($request);
        });
    }

    public function vote(Request $request) {
        $keyword = "";
        $act = ["delete"=>"Xóa tạm thời"];
        $state = $request->input('state');
        if($state == 'trash') {
            $act = ["restore"=>"Khôi phục", "forceDelete" => "Xóa vĩnh viễn"];
            $comments = Comment::onlyTrashed()->where("fullname", "LIKE", "%{$keyword}%")->paginate(100);
        } else {
            if($keyword = $request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $comments = Comment::where("fullname", "LIKE", "%{$keyword}%")->paginate(100);
        }
        $count_active = Comment::count();
        $count_trash = Comment::onlyTrashed()->count();
        $count_state = [$count_active, $count_trash];
        return view('admin.vote.show', compact('comments', 'count_state', 'act'));
    }

    public function delete($id) {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('admin/vote/list')->with('status', 'Xóa đánh giá sản phẩm thành công');
    }

    public function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == 'delete') {
                    Comment::destroy($list_check);
                    return redirect('admin/vote/list')->with('status', 'Xóa đánh giá sản phẩm thành công');
                }
                if($act == 'restore') {
                    Comment::withTrashed()->whereIn("id", $list_check)->restore();
                    return redirect('admin/vote/list')->with('status', 'Khôi phục đánh giá sản phẩm thành công');
                }
                if($act == 'forceDelete') {
                    Comment::withTrashed()->whereIn("id", $list_check)->forceDelete();
                    return redirect('admin/vote/list')->with('status', 'Xóa vĩnh viễn đánh giá sản phẩm thành công');
                }
                return redirect('admin/vote/list')->with('error', 'Vui lòng chọn thao tác để thực hiện thao tác');
            }
        } else {
            return redirect('admin/vote/list')->with('error', 'Vui lòng chọn bản ghi để thực hiện thao tác');
        }
    }

    public function detail($id) {
        $comment = Comment::find($id);
        $product = Product::find($id);
        return view("admin.vote.detail", compact("comment", "product"));
    }
}
