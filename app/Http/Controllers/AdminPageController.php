<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(["module_active"=>"page"]);
            return $next($request);
        });
    }

    public function show(Request $request) {
        $keyword = "";
        $state = $request->input('state');
        $act = [
            "delete" => "Xóa tạm thời",
        ];
        if($state == 'trash') {
            $act = [
                "restore" => "Xóa tạm thời",
                "forceDelete" => "Xóa vĩnh viễn",
            ];
            $pages = Page::onlyTrashed()->where("title", "LIKE", "%{$keyword}%")->paginate(20);
        } else {
            if($request -> input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $pages = Page::where("title", "LIKE", "%{$keyword}%")->paginate(20);
        }
        $count_active = Page::count();
        $count_trash = Page::onlyTrashed()->count();
        $count_state = [$count_active, $count_trash];
        return view("admin.page.show", compact('pages', 'count_state', 'act'));
    }

    public function add() {
        return view("admin.page.add");
    }

    public function store(Request $request) {
        $request->validate(
            [
                "title" => "required|string",
                "author" => "required|string",
                "content" => "required|string",
            ],
            [
                "required" => ":attribute không được để trống",
                "string" => ":attribute phải ở dạng chuỗi",
            ],
            [
                "title" => "Tiêu đề trang",
                "author" => "Người đăng",
                "content" => "Nội dung trang",
            ]
        );

        Page::create(
            [
                "title" => $request->input('title'),
                "author" => $request->input('author'),
                "content" => $request->input('content'),
                "status" => $request->input('status'),
            ]
        );
        return redirect('admin/page/add')->with('status', 'Thêm trang mới thành công!');
    }

    function delete($id) {
        $page = Page::find($id);
        $page->delete();
        $page->update(['status'=>'wait']);
        return redirect('admin/page/list')->with('status', 'Xóa trang thành công!');
    }

    function update($id) {
        $page = Page::find($id);
        return view("admin.page.update", compact('page'));
    }

    function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == 'restore') {
                    Page::withTrashed()->whereIn("id", $list_check)->restore();
                    Page::whereIn("id", $list_check)->update(['status'=>'active']);
                    return redirect('admin/page/list')->with('status', 'Khôi phục trang thành công!');
                }
                if($act == 'delete') {
                    Page::whereIn("id", $list_check)->update(['status'=>'wait']);
                    Page::destroy($list_check);
                    return redirect('admin/page/list')->with('status', 'Khôi phục trang thành công!');
                }
                if($act == 'forceDelete') {
                    Page::withTrashed()->whereIn("id", $list_check)->forceDelete();
                    return redirect('admin/page/list')->with('status', 'Xóa vĩnh viễn trang thành công!');
                }
                return redirect('admin/page/list')->with('error', 'Vui lòng chọn thao tác để thực thi thao tác!');
            }
        } else {
            return redirect('admin/page/list')->with('error', 'Vui lòng tích chọn bản ghi để thực thi thao tác!');
        }
    }

    function update_store(Request $request, $id) {
        Page::where('id', $id)->update(
            [
                "title" => $request->input('title'),
                "author" => Auth::user()->name,
                "content" => $request->input('content'),
                "status" => $request->input('status'),
            ]
        );
        return redirect('admin/page/list')->with('status', 'Cập nhật trang thành công!');
    }
}
