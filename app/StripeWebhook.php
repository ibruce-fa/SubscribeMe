<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeWebhook extends Model
{
    const PAYMENT_FAILED_WH_KEY     = "payment_failed";
    const PAYMENT_SUCCEEDED_WH_KEY  = "payment_succeeded";
}
