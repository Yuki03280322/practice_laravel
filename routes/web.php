<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('tests/test', 'TestController@index');

Route::group(['prefix' => 'contact', 'middleware' => 'auth'], function() {
// Route::groupメソッドの最初の引数には共通の属性を配列で指定
// prefix => 'contact'このルートグループ内のURIを指定(URIにcontactをつけている)
//middleware => auth:認証されていれば表示する(認証されていなければ認証(ログイン)画面へ)
    Route::get('index', 'ContactFormController@index')->name('contact.index');//nameはつけておくとviewファイル処理が楽に
    Route::get('create', 'ContactFormController@create')->name('contact.create');
    Route::post('store', 'ContactFormController@store')->name('contact.store');
    Route::get('show/{id}', 'ContactFormController@show')->name('contact.show');
});
// Route::get('contact/index', 'ContactFormController@index'); contact/indexというパスが指定されたらContactFormControllerのindexアクションが起動
Auth::routes();//ファサードクラスvender/laravel/framework/illuminate/Routing/Router.phpに記述されているauthメソッドを呼び出している
// user系の認証のルーティングはこの1行で補うことが可能

Route::get('/home', 'HomeController@index')->name('home');
