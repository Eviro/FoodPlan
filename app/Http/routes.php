<?php
use foodplan\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


Route::get('/', function () {
    return view('site.template.siteTemplate');
});

Route::get('/madvare',function(){
   return View('site.madvare');
});


Route::group(['prefix' => 'api1'],function(){

    // add goods to database
    Route::post('madvare/add',function(Request $request){
       $data = $request->input('foodNames');
       foreach($data as $value)
       {
           if($value <> ""){
               Good::firstOrCreate(['displayname' => ucfirst($value)]);
           }
       }

        return Redirect::back();

    });


});
