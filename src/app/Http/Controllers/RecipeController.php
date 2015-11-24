<?php

namespace foodplan\Http\Controllers;

use foodplan\Recipe;
use Illuminate\Http\Request;
use foodplan\Plan;
use Illuminate\Support\Facades\Redirect;
use Redirect;
use foodplan\Http\Requests;
use foodplan\Http\Controllers\Controller;

class RecipeController extends Controller
{
    public function save(Request $request)
    {
        $name = $request->input('dishName');
        $components = $request->input('dishGoods');

        if ($name <> "") {
            $dish = Recipe::firstOrCreate(['dishname' => $name]);
            $dish->components = implode(',', $components);
            $dish->save();

        }
        return Redirect::back();
    }


    public function delete(Request $r)
    {
        Recipe::find($r->input('dishToDelete'))->delete();
        Plan::where('recipeid', $r->input('dishToDelete'))->delete();
        return Redirect::back()->with('status', 'Slettet');
    }
}
