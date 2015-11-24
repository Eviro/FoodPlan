<?php

use Illuminate\Database\Seeder;
use \foodplan\Component;

class ComponentsSeeder extends Seeder
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

        Component::insert($data);
    }
}
