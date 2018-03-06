<?php

namespace App;

use App\Mail\ConfirmAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Notification extends Model
{
    /** notification types */
    const CONFIRM_ACCOUNT_TYPE  = 1;
    const NEW_SUBSCRIPTION_TYPE = 2;
    const NEW_USER_TYPE         = 3;
    const SUPPORT               = 4;
    /** notification types */
    /** email types */
//    const CONFIRM_ACCOUNT_TYPE  = 1;
//    const NEW_SUBSCRIPTION_TYPE = 2;
//    const NEW_USER_TYPE         = 3;
//    const SUPPORT               = 4;
    /** email types */


    public function getNotifications($type, $email = null, $id = null)
    {
        return $this->where('type', $type)
                    ->where('recipient_email', $email)
                    ->orWhere('recipient_id', $id)
                    ->get();
    }

    /** THIS CODE SHOULD BE IN THE MODEL */
    public function createNotification(Request $request) {
        $this->type = $request->get('type');
        $this->recipient_id = $request->get('recipient_id') ?: 0;
        $this->subject = $request->get('subject');
        $this->body = $request->get('body');
        $this->save();


    }

    public function sendEmail($emailType, User $user = null, $dataArr = [])
    {
        if($emailType == self::CONFIRM_ACCOUNT_TYPE) {
            if ($user) {
                return Mail::to($user->email)->send(new ConfirmAccount($user->first, $user->email, $dataArr['activationToken']));
            } else {
                return false;
            }
        }

        return false;
    }

    public function getNotfication($notificationId){
        $notification = Notification::find($notificationId);
        return $notification;
    }

//    public function update($notificationId) {
//
//    }

//    public function delete($notificationId) {
//        $notification = new Notification();
//        return $notification->delete();
//    }
}
