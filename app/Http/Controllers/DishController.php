<?php

namespace foodplan\Http\Controllers;

use Illuminate\Http\Request;

use foodplan\Http\Requests;
use foodplan\Http\Controllers\Controller;

class DishController extends Controller
{
    public function save(Request $request)
    {
    	$dishName = $request->input('dishName');
        $dishGoods = $request->input('dishGoods');

        if ($dishName <> "")
        {
            $dish = Dish::firstOrCreate(['dishname' => $dishName]);
            $dish->goods = implode(',',$dishGoods);
            $dish->save();

        }


        return Redirect::back();
    }
}
