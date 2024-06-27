<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Post('/store/contact',[ApiController::class,'storecontact']);
Route::get('/get/post/{id}',[ApiController::class,'getpostdata']);
Route::get('/get/slider',[ApiController::class,'getsliderimages']);
Route::get('/get/newsletter',[ApiController::class,'getnewsletter']);
Route::get('/get/pages',[ApiController::class,'getpage']);
Route::get('/get/slidebar',[ApiController::class,'getslidebar']);
Route::get('get/gallery',[ApiController::class,'getGalleryimages']);
Route::get('get/teammembers',[ApiController::class,'getteam']);
Route::get('resource/category/{id}', [ApiController::class, 'getresourcedata']);
Route::get('/get/vedios', [ApiController::class, 'youtubedata']);
Route::get('get/contactDetails',[ApiController::class,'getcontactpage']);
Route::get('/get/Activity/list/{id}',[ApiController::class,'getactivitylist']);
Route::get('/get/menus',[ApiController::class,'getmenus']);
Route::get('/get/testimonial/{id}',[ApiController::class,'gettestimonialdata']);
Route::get('/get/kurnooldiocese/parish/{id}',[ApiController::class,'getparishdata']);
Route::get('/get/kurnooldiocese/preist/{id}',[ApiController::class,'getpreistdata']);
Route::get('/get/kurnooldiocese/religio/{id}',[ApiController::class,'getreligiodata']);
Route::get('/get/homepagee/sections',[HomeController::class,'gethomepagedetails']);
Route::get('/get/bishopprogram',[ApiController::class,'geteventdata']);
Route::get('/get/messages/{id}',[ApiController::class,'getmessagedata']);