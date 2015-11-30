<?php

namespace foodplan\Http\Controllers;

use Illuminate\Http\Request;
use foodplan\Recipe;
use foodplan\Component;
use foodplan\Plan;
use foodplan\Http\Requests;
use foodplan\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    // Render the index page for the site
    public function index()
    {

        $today = $this->getToday();
        $sevenDaysAgo = $this->getToday()->sub(new \DateInterval('P7D'));
        $dateArray = $this->getDateArray($sevenDaysAgo);

        // Get the current plan
        $plans = [];
        foreach ($dateArray as $date) {
            $plans[$date->format('d-m-y')] = Plan::where('timestamp', $date->getTimestamp())->first();
        }

        $recipes = Recipe::all();
        return view('site.homepage')->with([
            'dates' => $dateArray,
            'translate' => $this->getTranslateArray(),
            'today' => $today,
            'recipes' => $recipes,
            'currentPlans' => $plans
        ]);

    }

    public function shoppingListNextSevenDays($begindate)
    {
        $date = (\DateTime::createFromFormat('d-m-y', $begindate));
        $date->setTime(0, 0);
        $plans = [];
        $componentList = [];
        $list = [];
        // Get current plans
        for ($i = 1; $i < 7; $i++) {
            $plans[] = Plan::firstOrNew(['timestamp' => $date->getTimestamp()]);
            $date->add(new \DateInterval('P1D'));
        }

        foreach ($plans as $plan) {
            $list[] = $plan->recipe()->parts();
        }
        foreach ($list as $comps) {
            foreach ($comps as $component) {
                if (isset($componentList[$component->displayname])) {
                    $componentList[$component->displayname] += 1;
                } else {
                    $componentList[$component->displayname] = 1;
                }
            }
        }
        return View('site.shoppinglist')->with(compact('componentList'));
    }

    protected function getTranslateArray()
    {
        return [
            1 => 'Mandag',
            2 => 'Tirsdag',
            3 => 'Onsdag',
            4 => 'Torsdag',
            5 => 'Fredag',
            6 => 'Lørdag',
            7 => 'Søndag'
        ];
    }


    protected static function getToday()
    {
        return (new \DateTime())->setTime(0, 0);
    }

    protected static function getDateArray(\DateTime $date, $days = 14)
    {
        $dateArray = [];
        for ($i = 0; $i < $days; $i++) {
            $date->add(new \DateInterval('P1D'));
            $dateArray[] = clone $date;

        }
        return $dateArray;

    }


}
