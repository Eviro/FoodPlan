<?php

use Illuminate\Database\Seeder;
use \foodplan\Recipe;

class RecipeSeeder extends Seeder
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
				'displayname' => 'Pasta med Majs',
				'components' => "3,1"
			],
			[
				'displayname' => 'Majs med Mælk',
				'components' => "1,4"
			],
			[
				'displayname' => 'Ris med Majs',
				'components' => "2,1"
			],
			[
				'displayname' => 'Mælk med Ris',
				'components' => "4,2"
			],
			[
				'displayname' => 'Majs med ris',
				'components' => "1,2"
			],
        ];

        Recipe::insert($data);
    }
}
