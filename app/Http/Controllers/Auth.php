<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

use \App\Model\User;

class Auth extends Controller
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
			'status_code' => '200',
			'error_messages' => $e ?? '',
			'response'=>['uuid' => $uuid]
		]);
	}
	public function register(Request $r){
		//fillでinserしてるので
		$val_flg = true;
		$e = [];
		//何もなければデータを収納する
		if($r->name === ''){
			$e[] = confg('const.error.register_error.empty_name');
			$val_flg = false;
		}else if(mb_strlen($r->name, 'UTF-8') > 32){
			$e[] = confg('const.error.register_error.long_name');
			$val_flg = false;
		}
		DB::beginTransaction();
		if($val_flg){
			$user = new User();
			if(User::where('uuid', $r->uuid)->exists()){
				$e[] = config('const.error.register_error.already_uuid');
				DB::rollBack();
			}else{
				$user->uuid = $r->uuid;
				$user->name = $r->name;
				$user->save();
				DB::commit();
			}
		}
		//レスポンス
		return response()->json([
			'status_code' => '200',
			'error_messages' => $e ?? '',
			'response' => '',
		]);
	}
	public function get_session(Request $r){
		$e = [];
		
		//非常に簡単な認証を行った後にセッションを発行する
		if(User::where('uuid', $r->uuid)->exists()){
			$user = User::find(1);
			$token = $user->createToken('my-token');
			$r->session()->put('token', $token->plainTextToken);
		}else{
			$e[] = 'uuidが存在していません';
			$token = '';
		}
		//レスポンス
		return response()->json([
			'status_code' => '200',
			'error_messages' => $e ?? '',
			'response' => ['session_id' => ''],
		]);
	}
	
}
