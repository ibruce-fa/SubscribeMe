<?php

namespace App;

use App\Mail\ConfirmAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Notification extends Model
{
    /** notification types */
    const SUPPORT_NOTIFICATION                  = ['notification_id'=>1, 'name'=>'support', 'type'=>'','subject'=>'','body'=>''];
    const SUPPORT_ACKNOWLEDGE_NOTIFICATION      = ['notification_id'=>1, 'name'=>'support', 'type'=>'','subject'=>'','body'=>''];
    const SUPPORT_RESPONSE_NOTIFICATION         = ['notification_id'=>1, 'name'=>'support', 'type'=>'','subject'=>'','body'=>''];
    const WELCOME_USER_NOTIFICATION             = ['notification_id'=>2, 'name'=>'welcome_user'];
//    const SUPPORT_NOTIFICATON          = ['notification_id'=>3, 'name'=>'WELCOME_USER'];
//    const NEW_SUBSCRIPTION_TYPE = 2;
//    const SUPPORT               = 4;
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

    public function sendNotification(Request $request = null, $notificationType, User $user)
    {
        if($notificationType == self::WELCOME_USER_NOTIFICATION['notification_id']) {
            $this->type     = self::WELCOME_USER_NOTIFICATION['type'];
            $this->subject  = self::WELCOME_USER_NOTIFICATION['subject'];
            $this->body     = self::WELCOME_USER_NOTIFICATION['body'];
            $this->recipient_id = Auth::id();
            return $this->save();
        } elseif ($notificationType == self::SUPPORT_NOTIFICATION['notification_id']) {
            $this->type         = $request->get('type');
            $this->recipient_id = $request->get('recipient_id') ?: 0;
            $this->subject      = $request->get('subject');
            $this->body         = $request->get('body');
            $this->save(); // sends to us
            
            $userNotification           = new Notification(); // sends to the user 
            $userNotification->type     = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['type'];
            $userNotification->subject  = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['subject'];
            $userNotification->body     = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['body'];
            $userNotification->recipient_id = Auth::id();
            $userNotification->save();
            return true;
        }
        return false;
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
