<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(["module_active" => "user"]);
            return $next($request);
        });
    }

    function list(Request $request) 
    {
        $keyword = "";
        $act = ['delete'=>'Xóa tạm thời'];
        $state = $request->input('state');
        if($state == 'trash')
        {
            $act = [ 'restore' => 'Khôi phục', 'forceDelete' => 'Xóa vĩnh viễn' ];
            $users = User::onlyTrashed()->where("name", "LIKE", "%{$keyword}%")->paginate(10);
        } else {
            if($request->input('keyword'))
            {
                $keyword = $request->input('keyword');
            }
            $users = User::where("name", "LIKE", "%{$keyword}%")->paginate(10);
        }
        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();
        $count_user = array($count_user_active, $count_user_trash);
        return view("admin.user.list", compact("users", "count_user", "act", "state"));
    }

    function add() 
    {
        return view("admin.user.add");
    }

    function add_store(Request $request) 
    {
        $request->validate
        (
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed',],
                'password_confirmation' => ['required', 'string', 'min:8'],
                'role' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống',
                'string' => ':attribute phải ở dạng chuỗi ký tự',
                'email' => ':attribute không đúng định dạng',
                'min' => ':attribute nhập vào phải có ít nhất là :min ký tự',
                'max' => ':attribute chỉ cho phép nhập vào tối đa là :max ký tự',
                'unique' => ':attribute đã tồn tại trên hệ thống',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
            ],
            [
                'name' => 'Họ và tên',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'password_confirmation' => 'Xác nhận mật khẩu',
                'role' => 'Nhóm quyền'
            ]
        );
        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'author' => Auth::user()->name,
                'level' => 1,
                'role' => $request->role,
                'status' => 'active',
            ]
        );
        return redirect('admin/user/add')->with('success', 'Thêm người dùng thành công');
    }

    function delete($id)
    {
        $user = User::where('id', $id);
        $user->where('id', $id)->update(['status' => 'trash']);
        $user->delete();
        return redirect('admin/user/list')->with('success', 'Xóa người dùng thành công');
    }

    function action(Request $request) 
    {
        $list_check = $request->input('list_check');
        if($list_check) {
            foreach($list_check as $key => $id) 
            {
                if(Auth::user()->id == $id) {
                    unset($list_check[$key]);
                    return redirect('admin/user/list')->with('error', 'Không thể thao tác trên tài khoản của mình!');
                }
            }

            if(!empty($list_check)) 
            {
                $action = $request->input('act');
                if($action == 'delete') 
                {
                    User::withTrashed()->whereIn('id', $list_check)->update(['status' => 'trash']);
                    User::destroy($list_check);
                    return redirect('admin/user/list')->with('success', 'Xóa người dùng thành công');
                }
                if($action == 'restore') 
                {
                    User::withTrashed()->whereIn('id', $list_check)->update(['status' => 'active']);
                    User::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/user/list')->with('success', 'Khôi phục người dùng thành công');
                }
                if($action == 'forceDelete') 
                {
                    User::withTrashed()->whereIn('id', $list_check)->forceDelete();
                    return redirect('admin/user/list')->with('success', 'Xóa vĩnh viễn người dùng thành công');
                }
                return redirect('admin/user/list')->with('error', 'Cần chọn thao tác để thực thi thao tác!');
            }
        } else {
            return redirect('admin/user/list')->with('error', 'Thao tác không hợp lệ!');
        }
    }

    function update($id)
    {
        $userById = User::find($id);
        return view('admin.user.update', compact('userById'));
    }

    function updateStore(Request $request, $id)
    {
        $request->validate
        (
            [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed',],
                'password_confirmation' => ['required', 'string', 'min:8'],
                'role' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống',
                'string' => ':attribute phải ở dạng chuỗi ký tự',
                'min' => ':attribute nhập vào phải có ít nhất là :min ký tự',
                'max' => ':attribute chỉ cho phép nhập vào tối đa là :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
            ],
            [
                'name' => 'Họ và tên',
                'password' => 'Mật khẩu',
                'password_confirmation' => 'Xác nhận mật khẩu',
                'role' => 'Nhóm quyền'
            ]
        );

        User::where('id', $id)->update(
            [
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]
        );
        return redirect('admin/user/list')->with('success', 'Cập nhật người dùng thành công');
    }
}
