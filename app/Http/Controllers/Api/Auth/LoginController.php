<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class LoginController extends Controller
{
    //
    function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret'=> 'T4N4jwuc6cDBnPvFFabPt8MpIq0XM9kiyrYK79Bl',
            'username' => $request->username,
            'password' => $request->password
        ]);
        $requestToken = Request::create(env('APP_URL').'/oauth/token', 'post');
        return Route::dispatch($requestToken);
    }

    function destroy()
    {
        \request()->user()->token()->revoke();
        return response()->noContent();
    }
}
