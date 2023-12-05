<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProfileController;
use App\Models\Blog;

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

// These are UnAuthentication routes
Route::controller(AuthController::class)->group(function () {
    Route::post('user/register', 'userRegister')->name('user.Register');
    Route::post('user/login', 'userLogin')->name('user.Login');

    Route::get('user/blogsList', [BlogController::class, 'blogsList'])->name('blog.list');
    Route::get('user/categoryList', [CategoryController::class, 'categoryList'])->name('category.list');
    Route::get('user/blog/{blog_id}/comments', [CommentController::class, 'commentList'])->name('comment.list');
});


Route::group(['prefix' => 'user', 'middleware' => ['auth:sanctum']], function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('profile', 'userProfile')->name('user.Profile');
        Route::get('logout',  'userLogout')->name('user.Logout');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::post('categoryCreate', 'categorycreate')->name('category.create');
        Route::get('categoryDetails/{id}', 'categorydetails')->name('category.details');
        Route::post('categoryUpdate/{id}', 'categoryUpdate')->name('category.update');
        Route::delete('categoryDelete/{id}', 'categoryDelete')->name('category.delete');
    });

    Route::controller(BlogController::class)->group(function () {
        Route::post('blogCreate', 'blogCreate')->name('blog.create');
        Route::get('blogDetails/{id}', 'Blogdetails')->name('blog.details');
        Route::put('blog/{id}/update', 'blogUpdate')->name('blog.update');
        Route::delete('blog/{id}/delete', 'blogDelete')->name('blog.delete');
        Route::post('blogs/{id}/toggle-like', 'blogToggleLike')->name('blog.toggle_like');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('blog/{blog_id}/comments/create', 'commentCreate')->name('comment.create');
        Route::put('comment/{comment_id}/update', 'commentUpdate')->name('comment.update');
        Route::delete('comment/{comment_id}/delete', 'commentDelete')->name('comment.delete');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::post('/profile/changePassword', 'changePassword')->name('profile.changePassword');
        Route::post('/profile/updateProfile', 'updateProfile')->name('profile.updateProfile');
    });
});
