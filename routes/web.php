<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/api', function(Request $request){
    $data = $request->only('slack_name', 'track');
    $validator = Validator::make($data, [
        'slack_name' =>'required|string',
        'track' => 'required|string'
    ]);

    if($validator->fails()){
        return response()->json(['error' => $validator->messages()], 200); 
    }

    $cur_date = new DateTime('now', new DateTimeZone('UTC')); 
    $response = response()->json([
        "slack_name" => $request->slack_name,
        "current_day" => date('l'),
        "utc_time"=> $cur_date->format('Y-m-d\TH:i:sp'),
        "track" => "backend",
        "github_file_url" => 'https://github.com/7j4n1/hng-taskone/blob/main/routes/api.php',
        "github_repo_url" => "https://github.com/7j4n1/hng-taskone",
        "status_code" => 200,
    ], 200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

    return $response;
});