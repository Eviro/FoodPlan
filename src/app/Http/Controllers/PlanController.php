<?php

namespace foodplan\Http\Controllers;

use Illuminate\Http\Request;
use \foodplan\Plan;
use foodplan\Http\Requests;
use foodplan\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanController extends Controller
{
	 use SoftDeletes;
	 protected $dates = ['deleted_at'];
    public function getForTimestamp($timestamp)
    {

    	return Plan::where('datestamp',$timestamp);
    }

    public function timestampSave(Request $request)
    {

    	// Confirm that all data is there
    	$this->validate($request,[
    		'timestamp' => 'required',
    		'recipeid' => 'required'
    		]);

    	// data is valid

    	$oldPlan = Plan::where('timestamp',$request->input('timestamp'));
    	$oldPlan->delete();

        // if recipeid = clear dont create a new plan

        if($request->input('recipeid') !== 'clear')
        {
            $plan = new Plan();

            $plan->timestamp = $request->input('timestamp');
            $plan->recipeid = $request->input('recipeid');
            $plan->save();

        }
            return Response()->json(['status'=>'success','timestamp' => $request->input('timestamp')]);

    	

    }
}
