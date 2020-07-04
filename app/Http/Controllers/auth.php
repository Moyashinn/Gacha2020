<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use \App\User;

class auth extends Controller
{
    public function uuid(){
		//uuid生成
		$uuid = (string) Str::uuid();
		//レスポンス
		return response()->json(['response'=>['uuid' => $uuid],'status_code' => http_response_code()]);
	}
	public function register(Request $r){
		$user = new User;
		$user->uuid = $r->uuid;
		$user->name = $r->name;
		return response();
	}
	
}
