<?php

namespace App;

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

}


