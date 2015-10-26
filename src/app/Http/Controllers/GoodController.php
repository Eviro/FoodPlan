<?php

namespace foodplan\Http\Controllers;

use Illuminate\Http\Request;
use \foodplan\Good;
use \foodplan\Dish;
use Redirect;
use foodplan\Http\Requests;
use foodplan\Http\Controllers\Controller;

class GoodController extends Controller
{
    public function save(Request $request)
    {
    	$data = $request->input('foodNames');
       foreach($data as $value)
       {
           if($value <> ""){
               Good::firstOrCreate(['displayname' => ucfirst($value)]);
           }
       }

        return Redirect::back();
    }

    public function delete(Request $request)
    {
      $deleteID = $request->input('goodToDelete');
      // Check if delete is allowed

      $matches = Dish::where('goods','like','%'.$deleteID.'%')->count();
      
      if ($matches > 0)
      {
        return Redirect::back()->with('status','Kan ikke slette, er i brug i '.$matches.' retter. Slet disse først');

      }
      else
      {
        Good::find($deleteID)->delete();
        return Redirect::back()->with('status','Slettet');
      }



    }
}
