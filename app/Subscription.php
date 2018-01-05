<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name',
        'stripe_id',
        'stripe_plan',
        'business_owner_id',
        'quantity',
        'is_checking_in',
        'current_usage_month',
        'trial_ends_at',
        'ends_at'
    ];

    public function getCustomer() {
        return $this->belongsTo('App\User');
    }

    public function getSubscriptionService() {
        return $this->belongsTo('App\SubscriptionService');
    }

}


