<?php

use App\Http\Controllers\FrcController;
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

Route::get('/', [FrcController::class, 'index']);

Route::get('/{path}', [FrcController::class, 'show']);

Route::get('/post/{id}', [FrcController::class, 'showPost']);

Route::post('/posts/create/{path}/{board}', [FrcController::class, 'store']);

Route::post('/posts/reply/{post_id}', [FrcController::class, 'storeReply']);
