<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name',
        'stripe_id',
        'stripe_plan',
        'plan_id',
        'business_owner_id',
        'status',
        'quantity',
        'is_checking_in',
        'last_usage_date',
        'uses',
        'trial_ends_at',
        'ends_at'
    ];

    public function getCustomer() {
        return $this->belongsTo('App\User');
    }

    public function getSubscriptionService() {
        return $this->belongsTo('App\SubscriptionService');
    }

    public function plan() {
        return Plan::where('id',$this->plan_id)->first();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function getRefundStatusAndAmount($subscription) {

        setStripeApiKey('secret');
        $stripeSubscription = \Stripe\Subscription::retrieve($subscription->stripe_id);
        $todaysDate = new DateTime();
        $paidDate = new DateTime();
        $paidDate->setTimestamp($stripeSubscription->current_period_start);
        $refundStatus = [
            'refund' => false,
            'amount' => 0
        ];

        if($paidDate >= $todaysDate && $subscription->uses < 1) {
            $refundStatus['refund'] = true;
            $refundStatus['amount'] = formatPrice($subscription->price);

            self::issueRefund($subscription); // here we will issue the refund
        }

        return $refundStatus;
    }

    public static function issueRefund($subscription) {

        setStripeApiKey('secret');

        \Stripe\Refund::create(array(
            "charge" => $subscription->last_charge_id
        ));
    }

}


