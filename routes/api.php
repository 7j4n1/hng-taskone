<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/', function(Request $request){
    $data = $request->only('slack_name', 'track');
    $validator = Validator::make($data, [
        'slack_name' =>'required|string',
        'track' => 'required|string'
    ]);

    if($validator->fails()){
        return response()->json(['error' => $validator->messages()], 200); 
    }

    $cur_date = new DateTimeImmutable('now', new DateTimeZone('UTC')); 
    return response()->json([
        "slack_name" => $request->slack_name,
        "current_day" => date('l'),
        "utc_time"=> $cur_date->format('Y-m-d\TH:i:sZ'),
        "track" => "backend",
        "github_file_url" => "",
        "github_repo_url" => "",
        "status_code" => 200,
    ]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});