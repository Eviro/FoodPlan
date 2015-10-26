<?php

use Illuminate\Database\Seeder;
use \foodplan\Dish;

class DishsSeeder extends Seeder
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
				'dishname' => 'Pasta med Majs',
				'goods' => "3,1"
			],
			[
				'dishname' => 'Majs med Mælk',
				'goods' => "1,4"
			],
			[
				'dishname' => 'Ris med Majs',
				'goods' => "2,1"
			],
			[
				'dishname' => 'Mælk med Ris',
				'goods' => "4,2"
			],
			[
				'dishname' => 'Majs med ris',
				'goods' => "1,2"
			],
        ];

        Dish::insert($data);
    }
}
