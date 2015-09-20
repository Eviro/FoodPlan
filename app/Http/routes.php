<?php
use foodplan\Dish;
use foodplan\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


Route::get('/', "SiteController@index");

Route::get('/madvare',function(){
   return View('site.madvare');
});

Route::get('/retter',function(){
    return View('site.retter')->with(['goodsList' => Good::all()]);
});


Route::group(['prefix' => 'api1'],function(){

    // Save new goods to the database
    Route::post('good/add',"GoodController@save");
    // Save new dish to the database
    Route::post('dish/add',"DishController@save");


    // Get plan for a given timestamp
    Route::get('plan/timestamp/{$timestamp}','PlanController@getForTimestamp');

    // Save a new plan to database
    Route::post('plan/timestamp/save',"PlanController@timestampSave");


});
