<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\propositionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;// ajouter le chemin au controlleur utilisé dans les routes
use App\Http\Controllers\actualiteController;
use App\Http\Controllers\chatMessageController;
use App\Http\Controllers\meetingReponseController;
use App\Http\Controllers\instantChatController;
use App\Http\Controllers\visitController;
use App\Http\Controllers\stageController;
use Illuminate\Session\Middleware\AuthenticateSession;

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

Route::post('login/', [AuthenticatedSessionController::class, 'store']);
Route::post('logout/', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('add/', [AuthenticatedSessionController::class, 'addUser'])->middleware('auth:sanctum');

Route::get('propositions/', [propositionController::class, 'index']);
Route::get('propositions/{proposition}', [propositionController::class, 'show']);
Route::post('propositions', [propositionController::class, 'store']);
Route::put('propositions/{proposition}', [propositionController::class, 'update']);
Route::delete('propositions/{proposition}', [propositionController::class, 'delete']);

Route::get('actualites/', [actualiteController::class, 'index']);
Route::get('actualites/{actualite}', [actualiteController::class, 'show']);
Route::post('actualites', [actualiteController::class, 'store']);
Route::put('actualites/{actualite}', [actualiteController::class, 'update']);
Route::delete('actualites/{actualite}', [actualiteController::class, 'delete']);

Route::get('chat_messages/', [chatMessageController::class, 'index']);
Route::get('chat_messages/{chat_message}', [chatMessageController::class, 'show']);
Route::post('chat_messages', [chatMessageController::class, 'store']);
Route::put('chat_messages/{chat_message}', [chatMessageController::class, 'update']);
Route::delete('chat_messages/{chat_message}', [chatMessageController::class, 'delete']);


Route::get('meetings/', [meetingController::class, 'index']);
Route::get('meetings/{meeting}', [meetingController::class, 'show']);
Route::post('meetings', [meetingController::class, 'store']);
Route::put('meetings/meeting}', [meetingController::class, 'update']);
Route::delete('meetings/{meeting}', [meetingController::class, 'delete']);

Route::post('meetings/accepter/{meeting}',[meetingReponseController::class, 'repondre_positif']);
Route::post('meetings/refuser/{meeting}',[meetingReponseController::class, 'repondre_negatif']);

Route::get('visits/', [visitController::class, 'index']);
Route::get('visits/{visit}', [visitController::class, 'show']);
Route::post('visits', [visitController::class, 'store']);
Route::put('visits/{visit}', [visitController::class, 'update']);
Route::delete('visits/{visit}', [visitController::class, 'delete']);

Route::get('stages/', [stageController::class, 'index']);
Route::get('stages/{stage}', [stageController::class, 'show']);
Route::post('stages', [stageController::class, 'store']);
Route::put('stages/stage}', [stageController::class, 'update']);
Route::delete('stages/{stage}', [stageController::class, 'delete']);


Route::get('api/chat/', [instantChatController::class, 'index']);
Route::get('api/chat/{user}/messages',[instantChatController::class, 'fetchMessages']);
Route::post('api/chat/{user}/messages',[instantChatController::class, 'sendMessages']);