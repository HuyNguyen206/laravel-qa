<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    function test()
    {

        dd();
        dump(\Auth::user()->questions);
        dump(\Auth::user()->answers);
        dump($post = \Auth::user()->questions->toBase()->merge(\Auth::user()->answers));
    }
}
