<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    /**
     * CLASS NOTES:
     * This is the table we will use to keep track uses of a service in case that the service has limits
     */

    protected $fillable = [
        'customer_id',
        'business_id',
        'business_owner_id',
        'stripe_plan_id',
        'uses'
    ];


    public function getUser()
    {
        return $this->belongsTo('App\User');
    }

    public function getBusiness()
    {
        return $this->belongsTo('App\Business');
    }

    public function getService()
    {
        return $this->belongsTo('App\SubscriptionService');
    }

}
