<?php

namespace App;

use App\Mail\ConfirmAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Email extends Model
{
    const CONFIRM_ACCOUNT_EMAIL = 1;
    
    public static function sendConfirmAccountEmail(User $toUser, $activationToken) {
        return Mail::to($toUser->email)->send(new ConfirmAccount($toUser->first , $toUser->email, $activationToken));
    }
}
