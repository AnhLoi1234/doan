<?php

use App\Http\Controllers\C_blog;
use App\Http\Controllers\C_book_list;
use App\Http\Controllers\User\C_User;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/admin-register', 'Admin\C_Admin@register');
Route::post('/admin-login', 'Admin\C_Admin@login');
Route::get('/admin-information', 'Admin\C_Admin@adminAuth')->middleware(['auth:api_admin', 'scopes:admin']);

//admin 
Route::get('/doctors', 'Admin\C_Admin@getDoctor');
Route::get('/doctor-admin', 'Admin\C_Admin@getDoctorAdmin');

//user
Route::post('/user-register-check', 'User\C_User@confirmEmail');
Route::post('/user-register', 'User\C_User@register');
Route::post('/user-login', 'User\C_User@login');
Route::get('/user-information', 'User\C_User@userAuth')->middleware(['auth:api_user', 'scopes:user']);
Route::get("/users", 'User\C_User@getAllUser');

// specicallist
Route::get('/specicallists/{id}', 'C_specical_list@getSpecicalListById');
Route::post('/specicallist-search', 'C_specical_list@searchSpecicalList');
Route::get('/specicallists', 'C_specical_list@getSpecicalList');
Route::post('/specicallists', 'C_specical_list@addSpecicalList');
Route::put('/specicallists', 'C_specical_list@updateSpecicalList');
Route::delete('/specicallists/{id}', 'C_specical_list@deleteSpecicalList');

//time book
Route::post('/timebook-search', 'C_time_book@searchTimeBook');
Route::get('/timebooks', 'C_time_book@getAllTimeBook');
Route::get('/timebooks/{id}', 'C_time_book@getTimeBookById');
Route::post('/timebooks', 'C_time_book@addTimeBook');
Route::put('/timebooks', 'C_time_book@updateTimeBook');
Route::delete('/timebooks/{id}', 'C_time_book@deleteTimeBook');

//book list
Route::get('/booklists', 'C_book_list@addBookList');
Route::get('/booklist-limit', 'C_book_list@getBookListLimit');
Route::get('/booklists/{id}', 'C_book_list@getBookListById');
Route::post('/booklists', 'C_book_list@addBookList');
Route::put('/booklists', 'C_book_list@addBookList');
Route::delete('/booklists', 'C_book_list@deleteBookList');

// upload 
Route::post('/uploadImage', 'C_upload@upload');
Route::post('/deleteImage', 'C_upload@delete');

// time doctor 
Route::get('/timedoctors', 'C_time_doctor@getAllTimeDoctor');
Route::post('/timedoctors', 'C_time_doctor@addTimeDoctor');
Route::put('/timedoctors', 'C_time_doctor@editTimeDoctor');
Route::delete('/timedoctors', 'C_time_doctor@deleteTimeDoctor');

//blog
Route::get('/blogs/{id}', 'C_blog@getBlogById');
Route::get('/blogs', 'C_blog@getBlog');
Route::post('/blog-search', 'C_blog@searchBlog');
Route::post('/blogs', 'C_blog@addBlog');
Route::put('/blogs', 'C_blog@editBlog');
Route::delete('/blogs/{id}', 'C_blog@deleteBlog');
Route::get('/update-view-blog/{id}', 'C_blog@updateViewBlog');

//dashboard 
Route::get('/dashboard', function () {
    $cUser = new C_User;
    $cBlog = new C_blog;
    $cBookList = new C_book_list;
    $user = $cUser->getAllUser();
    $blog = $cBlog->getBlog();
    $bookList = $cBookList->getAllBookList();
    return response()->json([
        'user' => $user,
        'blog' => $blog,
        'bookList' => $bookList
    ]);
});
