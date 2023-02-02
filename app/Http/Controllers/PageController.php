<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about() {
        $page = Page::where("title","LIKE" ,"%Giới thiệu%")->get()[0];
        return view("page.about", compact("page"));
    }
    public function contact() {
        $page = Page::where("title","LIKE" ,"%Liên hệ%")->get()[0];
        return view("page.contact", compact("page"));
    }
}
