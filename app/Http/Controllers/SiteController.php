<?php

namespace foodplan\Http\Controllers;

use Illuminate\Http\Request;
use foodplan\Dish;
use foodplan\Good;

use foodplan\Http\Requests;
use foodplan\Http\Controllers\Controller;

class SiteController extends Controller
{
	// Render the index page for the site
    public function index()
    {
    $date = new \DateTime();
    $today = clone $date;
    $date->sub(new \DateInterval('P7D'));
    $dateArray = [];
    for ($i=0; $i< 14;$i++)
    {
        $date->add(new \DateInterval('P1D'));
        $dateArray[] = clone $date;

    }

    $translateday = [
        1 => 'Mandag',
        2 => 'Tirsdag',
        3 => 'Onsdag',
        4 => 'Torsdag',
        5 => 'Fredag',
        6 => 'Lørdag',
        7 => 'Søndag'
    ];

    // Retter til dropdown
    $dishesArray = [];

    $dishes = Dish::all();


    foreach($dishes as $dish)
    {
        $data = ['dishname' => $dish->dishname, 'dishid' => $dish->id];
        $data['goods'] = [];

        foreach (explode(',',$dish->goods) as $goodid)
        {
            $data['goods'][] = Good::find($goodid)->displayname;
        }
        $dishesArray[] = $data;
        unset($data);

    }
 return view('site.homepage')->with([
      'dates' => $dateArray,
      'translate' => $translateday,
      'today' => $today,
      'dishes' => $dishesArray
  ]);

}
}
