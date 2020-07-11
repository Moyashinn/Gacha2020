<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use \App\Model\User;

class auth extends Controller
{
    public function uuid(){
		//ユニークなuuid生成
		do{
			$uuid = (string) Str::uuid();
			if(User::where('uuid', $uuid)->exists()){
				$uuid = null;
			}
		}while($uuid === null);
		//レスポンス
		return response()->json([
			'status_code' => http_response_code(),
			'error_messages' => $e ?? '',
			'response'=>['uuid' => $uuid]
		]);
	}
	public function register(Request $r){
		//fillでinserしてるので
		$insert_flg = true;
		$e = [];
		//重複用の結果は外に出しておく
		$uuid_exists = User::where('uuid', $r->uuid)->exists();
		//何もなければデータを収納する
		$user = new User();
		if($uuid_exists){
			$e[] = config('const.error.register_error.already_uuid');
			$insert_flg = false;
		}else{
			$user->uuid = $r->uuid;
		}
		var_dump($insert_flg);
		if($r->name === ''){
			$e[] = confg('const.error.register_error.empty_name');
			$select_flg = false;
		}else if(mb_strlen($r->name, 'UTF-8') > 32){
			$e[] = confg('const.error.register_error.long_name');
			$select_flg = false;
		}else if($insert_flg){
			$user->name = $r->name;
			$user->save();
		}
		//レスポンス
		return response()->json([
			'status_code' => http_response_code(),
			'error_messages' => $e ?? '',
			'response' => '',
		]);
	}
	
	
}
