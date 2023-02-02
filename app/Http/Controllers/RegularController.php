<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegularController extends Controller
{
    public function show() {
        return view("regular.show");
    }
}
