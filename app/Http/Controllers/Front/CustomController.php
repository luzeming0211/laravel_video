<?php

namespace App\Http\Controllers\Front;


use Illuminate\Http\Request;

class CustomController
{
    public function index(Request $request){
       return view('front.custom');
    }


}