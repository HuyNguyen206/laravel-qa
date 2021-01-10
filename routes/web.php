<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('test', 'TestController@test');
Route::view('{spa}', 'spa')->where('spa', '.*');
Route::get('/','QuestionController@index');



Route::get('/home', 'QuestionController@index')->name('home');
Route::resource('questions', 'QuestionController')->except('show');
Route::get('questions/{slug}', 'QuestionController@show')->name('questions.show');

Route::resource('questions.answers', 'AnswerController')->except('show', 'create');

Route::post('answer/{answer}/accept', 'AcceptAnswerController')->name('answer.accept');

Route::post('question/{question}/favorite', 'FavoriteController@store')->name('questions.favorite');
Route::delete('question/{question}/favorite', 'FavoriteController@destroy')->name('questions.unfavorite');

Route::post('question/{question}/vote', 'VoteQuestionController')->name('question.vote');
Route::post('answer/{answer}/vote', 'VoteAnswerController')->name('answer.vote');
