<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'email',
        'user_id',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'trial_ends_at'
    ];

    public function getSubscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

}
