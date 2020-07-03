<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class uuid extends Controller
{
    public function index(){
		$uuid = (string) Str::uuid();
		return response()->json(['response'=>['uuid' => $uuid],'status_code' => http_response_code()]);
	}
}
