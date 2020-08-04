<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Box;
use App\Model\Card;
class LootBox extends Controller
{
	/*
	//XXX認証呼び出し
	function __construct(){
		
	}
	*/
    function list(){
		//ガチャリストを出す
		$boxes = Box::get();
		return response()->json([
			'status_code' => '200',
			'error_messages' => $e ?? '',
			'response'=>[
				'decks' =>
					$boxes->toArray(),
			],
		]);
	}
	function drow($id, $cnt){
		//ガチャを施行する
		$cards = [];
		$decks = Card::where('box_id', $id)->get();
		$deck = $decks->toArray();
		$rarity = config('const.data.rarity');
		for($i = 1; $i <= $cnt; $i++){
			$cards[] = array_rand($rarity);
		}
		
		//XXXカードをユーザーのデッキに入れる
		
		return response()->json([
			'status_code' => '200',
			'error_messages' => $e ?? '',
			'response'=>[
				'decks' =>
					$card,
			],
		]);
	}
}
