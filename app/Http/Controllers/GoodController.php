<?php

namespace foodplan\Http\Controllers;

use Illuminate\Http\Request;

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
}
