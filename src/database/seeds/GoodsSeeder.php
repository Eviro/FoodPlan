<?php

use Illuminate\Database\Seeder;
use \foodplan\Good;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		'displayname' => 'Majs'
        	],
        	[
        		'displayname' => 'Ris'
        	],
        	[
        		'displayname' => 'Pasta'
        	],
        	[
        		'displayname' => 'Mælk'
        	],
        ];

        Good::insert($data);
    }
}
