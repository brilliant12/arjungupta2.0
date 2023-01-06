<?php

use App\Http\Controllers\SkillController;
use App\Models\Skill;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'],function()
{
    Route::get('skill',[SkillController::class,'index']);
    Route::post('skill',[SkillController::class,'create']);
    Route::get('skill/{id}',[SkillController::class,'edit']);
    Route::post('skill-update',[SkillController::class,'update']);
    Route::post('skill-delete',[SkillController::class,'delete']);
});
