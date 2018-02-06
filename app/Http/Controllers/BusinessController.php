<?php

namespace App\Http\Controllers;

use App\Location;
use App\Plan;
use Dompdf\Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Business;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Subscription;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $failMessage = "The business you requested does not exist";

    public function index()
    {
        if(Auth::user()->business_account != "1") {
            return redirect('/business/signup');
        } else {

            $stats = DB::select($this->getBusinessAccountStatsQuery());
            $projectedMonthlyIncome = $this->calulateMonthlyIncome();
            $businessIds = !count($stats) ? 0 :$stats[0]->bizCount;
            $planCount = !count($stats) ? 0 :$stats[0]->planCount;
            $subscriptionCount = !count($stats) ? 0 :$stats[0]->subCount;
            $data = [
              'businessId'            => Auth::user()->business->id,
              'businessCount'         => $businessIds,
              'planCount'             => $planCount,
              'subscriptionCount'     => $subscriptionCount,
              'name'                  => ucfirst(Auth::user()->first),
              'projectedMonthlyIncome'=> formatPrice($projectedMonthlyIncome)
            ];

            return view('business.business-home')->with('data', $data);
        }

    }

    public function viewStore(Request $request, $id) {
        $business = Business::find($id);
        $owner    = $business->user->id == Auth::id();
        $hasPhoto   = !empty($business->photo_path);
        $haslogo    = !empty($business->logo_path);
        return view('themes.base-theme.store-front')
            ->with('business',$business)
            ->with('hasPhoto',$hasPhoto)
            ->with('haslogo',$haslogo)
            ->with('active',"home")
            ->with('owner',$owner);
    }

    public function about(Request $request, $id) {
        $business = Business::find($id);
        $owner    = $business->user->id == Auth::id();
        $hasPhoto   = !empty($business->photo_path);
        $haslogo    = !empty($business->logo_path);
        return view('themes.base-theme.about')
            ->with('business',$business)
            ->with('hasPhoto',$hasPhoto)
            ->with('haslogo',$haslogo)
            ->with('active',"about")
            ->with('owner',$owner);
    }

    public function contact(Request $request, $id) {
        $business = Business::find($id);
        $owner    = $business->user->id == Auth::id();
        $hasPhoto   = !empty($business->photo_path);
        $haslogo    = !empty($business->logo_path);
        return view('themes.base-theme.contact')
            ->with('business',$business)
            ->with('hasPhoto',$hasPhoto)
            ->with('haslogo',$haslogo)
            ->with('active',"contact")
            ->with('owner',$owner);
    }

    public function viewService(Request $request,$planId) {
        $plan     = Plan::find($planId);
        $business = $plan->business;
        $hasPhoto   = !empty($business->photo_path);
        $haslogo    = !empty($business->logo_path);
        $owner    = $business->user->id == Auth::id();
        $publicStripeKey = getPublicStripeKey();
        return view('themes.base-theme.service')
            ->with('hasPhoto',$hasPhoto)
            ->with('haslogo',$haslogo)
            ->with('business',$business)
            ->with('active','')
            ->with('publicStripeKey',$publicStripeKey)
            ->with('plan',$plan)->with('owner',$owner);
    }

    public function signup()
    {
        /** @var Builder $allBusinessPlans */
        $businessAccountPlans = DB::table('plans')->where('is_app_plan', "1")->get();
        $publicStripeKey = getPublicStripeKey();

        return view('business.signup')->with('plans', $businessAccountPlans->toArray())->with('publicStripeKey',$publicStripeKey);
    }

    public function manageBusiness(Request $request = null)
    {
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $businesses = Business::where('user_id', Auth::id())->get();
        return view('business.manage-business')
            ->with('businesses', $businesses)
            ->with('days', $days);
    }

    public function updateBusinessPhoto(Request $request, $businessId)
    {
        if(!empty($request)) {
            $business = Business::find($businessId);
            if($business->photo_path) {
                unlink(getFullPathToImage($business->photo_path));
            }
            $path = $request->file('file')->store('public/images/business');
            $path = str_replace('public/','',$path); // fix path here so we can render properly. will likely be changed once we move to prod
            $business->photo_path = $path;
            $business->save();

            return redirect('/business/manageBusiness')->with('successMessage', "Photo uploaded successfully");
        } else {
            return redirect('/business/manageBusiness')->with('errorMessage', "request is empty");
        }
    }

    public function updateBusinessLogo(Request $request, $businessId)
    {
        if(!empty($request)) {
            $business = Business::find($businessId);
            if($business->logo_path) {
                unlink(getFullPathToImage($business->logo_path));
            }
            $path = $request->file('file')->store('public/images/business/logos');
            $path = str_replace('public/','',$path); // fix path here so we can render properly. will likely be changed once we move to prod
            $business->logo_path = $path;
            $business->save();

            return redirect('/business/manageBusiness')->with('successMessage', "Logo uploaded successfully");
        } else {
            return redirect('/business/manageBusiness')->with('errorMessage', "request is empty");
        }
    }

    public function deleteBusinessPhoto(Request $request, $businessId)
    {
        if(!empty($request)) {
            $business = Business::find($businessId);
            unlink(getFullPathToImage($business->photo_path));
            $business->photo_path = null;
            $business->save();

            return redirect('/business/manageBusiness')->with('infoMessage', "Photo deleted successfully");
        } else {
            return redirect('/business/manageBusiness')->with('errorMessage', "request is empty");
        }
    }

    public function deleteBusinessLogo(Request $request, $businessId)
    {
        if(!empty($request)) {
            $business = Business::find($businessId);
            unlink(getFullPathToImage($business->logo_path));
            $business->logo_path = null;
            $business->save();

            return redirect('/business/manageBusiness')->with('infoMessage', "Logo deleted successfully");
        } else {
            return redirect('/business/manageBusiness')->with('errorMessage', "request is empty");
        }
    }

    public function storePhoto(Request $request)
    {
        $path = $request->file('avatar')->store('avatars');

        return $path;
    }

    /** ^^^^^^^^ Frontend routes ^^^^^^^^ */

    public function createBusiness(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->business_account == 1)
        {
            try {
                $newBusiness = new Business($request->all());
                $newBusiness->user_id = Auth::id();
                $newBusiness->active = "1";
                $newBusiness->save();
                $user->business_id = $newBusiness->id;
                $user->save();
                $message = "Creation was successful";
            } catch (Exception $e) {
                $message = $e->getMessage();
            }

        } elseif ($user->business_account == 2) {
            $message = 'Your account is suspended. Please bring your account to up to date';
        } else {
            throw new AccessDeniedException("You must have a business account to perform this action");
        }

        return redirect('/business/manageBusiness')->with('successMessage', $message);
    }

    public function updateBusiness(Request $request, $id)
    {
        /** @var User $user */
        $user = Auth::user();
        $business = $this->findBusiness($id);
        if($business && $user->business_account == 1)
        {
            $business->update($request->all());
            return redirect('/business/manageBusiness');
        }

        return $this->failMessage;
    }

    public function deleteBusiness($id)
    {
        $business = DB::table('businesses')->where('id', $id)->first();
        if($business->delete()){
            return redirect('/business/manageBusiness');
        }

        // TODO: remove plans and subscriptions associated with
        // TODO: also, handle the case where a business may try to grab money
        // cont. from customers and delete their account early.
        return 'nah';
    }

    public function deactivateBusiness($id)
    {
        $business = $this->findBusiness($id);
        if ($business)
        {
            $business->active = "0";
            $business->save();
            return $business;
        }

        return $this->failMessage;
    }

    public function activateBusiness($id)
    {
        $business = $this->findBusiness($id);
        if ($business)
        {
            $business->active = "1";
            $business->save();
            return $business;
        }

        return $this->failMessage;
    }

    public function suspendBusiness($id)
    {
        $business = $this->findBusiness($id);
        if ($business)
        {
            $business->active = "2";
            $business->save();
            return $business;
        }

        return $this->failMessage;
    }

    private function getBusinessAccountStatsQuery(){
        $userId = Auth::id();
        return DB::raw("SELECT (
                                SELECT COUNT(id) from businesses where user_id = $userId
                                ) as bizCount,
                                (
                                SELECT COUNT(business_id) from plans where business_id = $userId
                                ) AS planCount,
                                
                                (
                                SELECT COUNT(business_id) from subscriptions where business_id = $userId
                                ) AS subCount
                                
                                FROM businesses;
                                ");
    }

    public function calulateMonthlyIncome()
    {
        $businessIds = DB::table('businesses')->where('user_id', Auth::id())->pluck('id');
        $income = 0;
        if(count($businessIds)) {
            $subs = DB::table('subscriptions')->whereIn('business_id',$businessIds)->get();
            if(count($subs)) {
                foreach ($subs as $sub)
                {
                    if($sub->sm_interval == 'year')
                    {
                        $income += ($sub->price/12);
                    } else {
                        $income += $sub->price;
                    }
                }
            }
        }

        return $income;
    }

    public function showCheckinView($businessId) {

        $checkins = \App\Subscription::where('business_id',$businessId)->where('is_checking_in', 1)->get();
        return view('business.checkins')->with('checkins', $checkins);
    }



    private function getUserObject()
    {
        return new User;
    }

    private function getBusinessObject()
    {
        return new Business;
    }

    public function findBusiness($id)
    {
        return $this->getBusinessObject()->find($id);
    }

    public function findUser($id)
    {
        return $this->getUserObject()->find($id);
    }

}
