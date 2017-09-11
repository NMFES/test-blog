<?php

use Illuminate\Http\Request;

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

// Posts
Route::get('post', 'PostController@index');
Route::get('post/{slug}', 'PostController@show');

// Contact
Route::post('contact/message', 'ContactController@message');

// Comments
Route::get('comment', 'CommentController@index');
Route::post('comment', 'CommentController@store');

// Auth
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('register', 'AuthController@register');
