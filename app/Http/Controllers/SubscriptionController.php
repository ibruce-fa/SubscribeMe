<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Subscription;
use App\SubscriptionService;
use App\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Billable;
use Stripe\Customer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SubscriptionController extends Controller
{
    use Billable;

    /**
     * The following are potential statuses for subscriptions
     * trialing
     * active
     * past_due
     * canceled
     * unpaid
     */

    public function showSubscriptionForm($planId)
    {
        /** @var Builder $allBusinessPlans */
        $interval = null;
        $price = null;
        if(strpos($planId, "year") > -1) {
            $planId = str_replace('_year','',$planId);
            $interval = "year";
        } elseif(strpos($planId, "month") > -1) {
            $planId = str_replace('_month','',$planId);
            $interval = "month";
        } else {
            throw new NotFoundHttpException("This page does not exist");
        }
        $planToSubscribe = DB::table('plans')->where('stripe_plan_id',$planId)->first();
        $publicStripeKey = getPublicStripeKey();
        if($interval == "year")
            $price = $planToSubscribe->year_price;
        else {
            $price = $planToSubscribe->month_price;
        }

        $data = [
          'publicStripeKey' => $publicStripeKey,
          'planToSubscribe' => $planToSubscribe,
          'interval'        => $interval,
          'price'           => $price
        ];

        return view('subscription.subscriptionForm')->with('data',$data);
    }


    public function createSubscription(Request $request)
    {
        /** @var User $user */
        if(Auth::id() <= 0 || Auth::id() != $request->user_id) {
            throw new AuthorizationException("You are not authorized to make this request");
        }

        setStripeApiKey("secret");
        $stripeToken    = $request->stripeToken;
        $planName       = $request->stripe_plan_name;
        $planIdentifier = $request->stripe_plan_id;
        $smPlanId       = $request->plan_id;
        $businessId     = $request->business_id;
        $isAppPlan      = $request->is_app_plan;
        $price          = $request->price;
        $interval       = $request->sm_interval;
        $user           = Auth::user();
        // First create the subscription in stripe
        $newStripeSubscription = $user->newSubscription($planName,$planIdentifier)->create($stripeToken);
        // if the above fails, we need to cancel the subscription
//        $subscription   = \Stripe\Subscription::retrieve($subscriptionId);
//        $subscription->cancel();

        $newStripeSubscription->current_usage_month = currentMonth();
        $newStripeSubscription->business_id         = $businessId;
        $newStripeSubscription->price               = $price;
        $newStripeSubscription->sm_interval         = $interval;
        $newStripeSubscription->plan_id             = $smPlanId;
        $newStripeSubscription->save();

        if($isAppPlan) {
            (new UserController())->activateBusinessAccount($user->id, $planIdentifier,$newStripeSubscription->id);
            return redirect('/business');
        }

        return redirect('/subscription/subscribed')
            ->with('interval', $interval)
            ->with('price', $price)
            ->with('planName', $planName);
    }


    public function updateSubscription(Request $request)
    {
        // NOTE: to pause an account, just set it to a "free" account.
        // This needs to be created in Stripe

        /** @var User $user */
        $user                 = Auth::user();
        $subscriptionId       = $user->subscription_id;
        $newPlan              = $request->plan_id;
        setStripeApiKey("secret");
        $subscription   = \Stripe\Subscription::retrieve($subscriptionId);
        $itemID         = $subscription->items->data[0]->id;

        \Stripe\Subscription::update($subscriptionId, array(
            "items" => array(
                array(
                    "id" => $itemID,
                    "plan" => $newPlan,
                ),
            ),
        ));
    }


    public function cancelSubscription(Request $request, $subscriptionId)
    {
        /** @var User $user */
        setStripeApiKey("secret");
        $user              = Auth::user();
        $localSubscription = Subscription::find($subscriptionId);

        try {
            $stripeSubscription = \Stripe\Subscription::retrieve($localSubscription->stripe_id);
        } catch (Exception $e) {
            return redirect()->back()->with("errorMessage", "There was a problem canceling your subscription. please try again or contact customer service {$localSubscription->stripe_plan}");
        }

        $stripeSubscription->cancel(); // need a catch here
        $localSubscription->delete();

        $isBusinessAcoount    = $request->is_business_account;

        if($isBusinessAcoount) {
            $user->business_account      = "0";
            $user->business_account_plan = null;
            $user->subscription_id       = null;
            $user->save();
        }

        return redirect()->back()->with("successMessage", "Subscription cancelled Successfully");

    }


    public function getSubscriptionStatus()
    {
        /** @var User $user */
        setStripeApiKey("secret");
        $user           = Auth::user();
        $subscriptionId = $user->subscription_id;
        $subscription   = \Stripe\Subscription::retrieve($subscriptionId);
        return $subscription->status;
    }

    public function checkIn(Request $request)
    {
        /** @var Subscription $subscription */
        $userId       = Auth::id();
        $planId       = $request->stripe_plan;
        $plan         = DB::table('plans')->where('stripe_plan_id',$planId)->get();
        $subscription = DB::table('subscriptions')->where('user_id',$userId)->where('stripe_plan',$planId)->get();

        if ($subscription->uses >= $plan->use_limit) {
            // this means the period is over and we need to reset
            if (currentMonth() != $subscription->current_usage_month) {
                $subscription->current_usage_month = currentMonth();
                $subscription->uses = 0;
            } else {
                return 'You have exceeded your limit for this month';
            }
        } else {
            $subscription->is_checking_in = "1";
            $subscription->save();
        }

        return $subscription;
    }

    public function getCheckIns()
    {
        $checkIns = DB::table('subscriptions')
                        ->where('business_owner_id',Auth::id())
                        ->where('is_checking_in',1)
                        ->get();
        return $checkIns;
    }

    public function confirmCheckIn(Request $request)
    {
        /** @var Subscription $subscription */
        $subscription = DB::table('subscriptions')->where('id',$request->id)->get();
        $subscription->uses = $subscription->uses + 1;
        $subscription->is_checking_in = "2";
        $subscription->save();
    }

    public function resetCheckIn(Request $request)
    {
        /** @var Subscription $subscription */
        $subscription = DB::table('subscriptions')->where('id',$request->id)->get();
        $subscription->is_checking_in = "0";
        $subscription->save();
    }

    public function subscribed()
    {
        return view('subscription.subscribed');
    }

}
