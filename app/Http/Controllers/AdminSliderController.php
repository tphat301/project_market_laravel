<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active'=>'slider']);
            return $next($request);
        });
    }

    public function show() {
        $sliders = Slider::withTrashed()->paginate(20);
        return view('admin.slider.show', compact('sliders'));
    }

    public function store(Request $request) {
        $request->validate(
            [
                'thumbnail' => ['required', 'unique:sliders'], 
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => ':attribute đã tồn tại trên hệ thống',
            ],
            [
                'thumbnail' => "Ảnh silder",
            ]
        );
        if($request->hasFile('thumbnail')) {
            $file = $request->thumbnail;
            $file_size = $file->getSize();
            $file_type = $file->getClientOriginalExtension();
            $file_name = $file->getClientOriginalName();
            $type_allow = ["png", "jpg", "jpeg", "gif"];
            $type = strtolower($file_type);
            if(!in_array($type, $type_allow)) {
                return redirect('admin/slider/list')->with('error', 'File tải lên không đúng định dạng png, jpeg, jpg, gif');
            } else {
                if($file_size > 26214400) {
                    return redirect('admin/slider/list')->with('error', 'File tải lên đã vượt quá 25MB');
                } else {
                    $file->move('public/uploads', $file_name);
                    $thumbnail = 'public/uploads/'.$file_name;
                }
            }
        } 
        Slider::create(
            [
                'thumbnail' => $thumbnail,
                'author' => Auth::user()->name,
                'status' => $request->status,
            ]
        );
        return redirect('admin/slider/list')->with('status', 'Thêm slider thành công');
    }

    public function convertStatus($id) {
        $slider = Slider::withTrashed()->find($id);
        if($slider->status == 'active') {
            $slider->update(['status'=>'trash']);
            $slider->delete();
        } else {
            $slider->restore();
            $slider->update(['status'=>'active']);
        }
        return redirect('admin/slider/list')->with('status', 'Chuyển trạng thái thành công');
    }

    public function delete($id) {
        $slider = Slider::find($id);
        $slider->update(['status'=>'trash']);
        $slider->delete();
        return redirect('admin/slider/list')->with('status', 'Xóa slider thành công');
    }
}
