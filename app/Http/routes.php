<?php
use foodplan\Dish;
use foodplan\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


Route::get('/', "SiteController@index");

Route::get('/madvare',function(){
   return View('site.madvare')->with('goods',Good::all());
});

Route::get('/retter',function(){
    return View('site.retter')->with(['goodsList' => Good::all(), 'dishList' => Dish::all()]);
});


Route::group(['prefix' => 'api1'],function(){

    // Save new goods to the database
    Route::post('good/add',"GoodController@save");

    // Delete a good from the database
    Route::post('good/delete',"GoodController@delete");

    // Delete a dish from the database
    Route::post('dish/delete',"DishController@delete");

    // Save new dish to the database
    Route::post('dish/add',"DishController@save");


    // Get plan for a given timestamp
    Route::get('plan/timestamp/{$timestamp}','PlanController@getForTimestamp');

    // Save a new plan to database
    Route::post('plan/timestamp/save',"PlanController@timestampSave");


});
