<?php

use Illuminate\Database\Seeder;

class TestData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxes')->insert([
			'name' => Str::random(10),
			'detail' => Str::random(10),
			'can_loot' => true,
		]);
		DB::table('cards')->insert([
			'box_id' => 1,
			'name' => Str::random(10),
			'offence' => rand(),
			'defence' => rand(),
			'text' => Str::random(10),
		]);
    }
}
