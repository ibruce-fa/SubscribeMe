<?php

namespace App\Http\Controllers;

use App\Location;
use App\Plan;
use Elasticsearch\Client;
use Elasticsearch\Transport;
use Illuminate\Http\Request;
use App\Repositories\ESPlanRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ESPlanRepository $ESPlanRepository, Request $request)
    {
        $location = Location::find($request->get('location_id') ?: Auth::user()->location_id);
        $kms = $request->get('miles') ? ($request->get('miles') * 1.61) . "km" : '16.10km'; // default distance is 10 miles | 8.05km == 5 mi
        $lat = $location ? $location->lat : null;
        $lng = $location ? $location->lng : null;

        $plans = $ESPlanRepository->search($request->get('searchField'), $lat, $lng, $kms);

        if($request->get('location_id') != Auth::user()->location_id && $request->get('location_id') > 0) {
            $user = Auth::user();
            $user->location_id = $request->get('location_id');
            $user->save();
        }


        return view('home')
            ->with('plans', $plans)
            ->with('count', count($plans))
            ->with('miles', $request->get('miles') > 0 ? $request->get('miles') : 10)
            ->with('location', $location ?: new Location())
            ->with('queryString', !empty($request->get('searchField')) ? $request->get('searchField') : '');
    }
}
