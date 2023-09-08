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

    $cur_date = new DateTimeImmutable('now', new DateTimeZone('UTC')); 
    return response()->json([
        "slack_name" => $request->slack_name,
        "current_day" => date('l'),
        "utc_time"=> $cur_date->format('Y-m-d\TH:i:sZ'),
        "track" => "backend",
        "github_file_url" => "https://github.com/7j4n1/hng-taskone/blob/main/routes/web.php",
        "github_repo_url" => "https://github.com/7j4n1/hng-taskone",
        "status_code" => 200,
    ]);
});
