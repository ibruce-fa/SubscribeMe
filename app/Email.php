<?php

namespace App;

use App\Mail\ConfirmAccount;
use App\Mail\MessageToCustomers;
use App\Mail\NotifyBusinessDeletion;
use App\Mail\NotifyBusinessModification;
use App\Mail\NotifyPlanDeletion;
use App\Mail\NotifyPlanModification;
use App\Mail\SubscribedUser;
use App\Mail\UnsubscribedUser;
use App\Mail\WelcomeBusiness;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Email extends Model
{

    public static function sendConfirmAccountEmail(User $toUser, $activationToken) { // done
        return Mail::to($toUser->email)->send(new ConfirmAccount($toUser->first , $toUser->email, $activationToken));
    }

    public static function sendNotifyBusinessDeletionEmail(User $toUser, Business $business) { //  done
        return Mail::to($toUser->email)->send(new NotifyBusinessDeletion($business));
    }

    public static function sendNotifyBusinessModificationEmail(User $toUser, Business $business) { // done
        return Mail::to($toUser->email)->send(new NotifyBusinessModification($business));
    }

    public static function sendNotifyPlanDeletionEmail(User $toUser, Business $business) { // done
        return Mail::to($toUser->email)->send(new NotifyPlanDeletion($business));
    }

    public static function sendNotifyPlanModificationEmail(User $toUser, Business $business) { // done
        return Mail::to($toUser->email)->send(new NotifyPlanModification($business));
    }

    public static function sendSubscribedUserEmail(User $toUser, $body) { //
        return Mail::to($toUser->email)->send(new SubscribedUser($body));
    }

    public static function sendUnsubscribedUserEmail(User $toUser, $body) {
        return Mail::to($toUser->email)->send(new UnsubscribedUser($body));
    }

    public static function sendWelcomeBusinessEmail(User $toUser, Business $business, $body) {
        return Mail::to($toUser->email)->send(new WelcomeBusiness($business, $body));
    }

    public static function sendMessageToCustomersEmail(User $toUser, Business $business, $body) {
        return Mail::to($toUser->email)->send(new MessageToCustomers($business, $body));
    }
}
