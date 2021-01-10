<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('get-token','Auth\LoginController@getToken');
//Route::get('questions/{question}','Api\QuestionController@show')->middleware('auth:api');
//Route::get('/questions/{question}-{slug}', 'Api\QuestionDetailController');
Route::get('questions','Api\QuestionController@index');
Route::get('questions/{question}/answers','Api\AnswerController@index');
Route::post('login', 'Api\Auth\LoginController@store');
Route::post('register', 'Api\Auth\RegisterController');
Route::get('questions/{slug}','Api\QuestionController@show');
Route::middleware('auth:api')->namespace('Api')->group(function(){
    Route::apiResource('questions', 'QuestionController')->except('index', 'show');
    Route::apiResource('questions.answers', 'AnswerController')->except('index');
    Route::post('questions/{question}/vote', 'VoteQuestionController');
    Route::post('answers/{answer}/vote', 'VoteAnswerController');

    Route::post('answers/{answer}/accept', 'AcceptAnswerController');
    Route::post('questions/{question}/favorite', 'FavoriteController@store');
    Route::delete('questions/{question}/favorite', 'FavoriteController@destroy');
    Route::delete('logout', 'Auth\LoginController@destroy');

    Route::get('posts', 'MyPostsController');
});


