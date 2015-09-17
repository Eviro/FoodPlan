<?php
use foodplan\Dish;
use foodplan\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


Route::get('/', function () {
    $date = new DateTime();
    $today = clone $date;
    $date->sub(new DateInterval('P7D'));
    $dateArray = [];
    for ($i=0; $i< 14;$i++)
    {
        $date->add(new DateInterval('P1D'));
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

});

Route::get('/madvare',function(){
   return View('site.madvare');
});

Route::get('/retter',function(){
    return View('site.retter')->with(['goodsList' => Good::all()]);
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


    Route::post('retter/add',function(Request $request){
        $dishName = $request->input('dishName');
        $dishGoods = $request->input('dishGoods');

        if ($dishName <> "")
        {
            $dish = Dish::firstOrCreate(['dishname' => $dishName]);
            $dish->goods = implode(',',$dishGoods);
            $dish->save();

        }


        return Redirect::back();

    });


});
