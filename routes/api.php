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
        Route::post('blogUpdate/{id}', 'blogUpdate')->name('blog.update');
        Route::delete('blogDelete/{id}', 'blogDelete')->name('blog.delete');
        Route::post('blogToggleLike/{id}', 'blogToggleLike')->name('blog.toggle_like');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('createComment/{blog_id}', 'commentCreate')->name('comment.create');
        Route::get('getComment/{comment_id}', 'commentList')->name('comment.list');
        Route::post('updateComment/{comment_id}', 'commentUpdate')->name('comment.update');
        Route::delete('deleteComment/{comment_id}', 'commentDelete')->name('comment.delete');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::post('changePassword', 'changePassword')->name('profile.changePassword');
        Route::post('updateProfile', 'updateProfile')->name('profile.updateProfile');
    });
});
