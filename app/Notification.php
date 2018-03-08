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
    const SUPPORT_NOTIFICATION                  = ['type_id'=>1, 'name'=>'support', 'type'=>'','subject'=>'','body_template'=>''];
    const SUPPORT_ACKNOWLEDGE_NOTIFICATION      = ['type_id'=>2, 'name'=>'support', 'type'=>'','subject'=>'','body_template'=>''];
    const SUPPORT_RESPONSE_NOTIFICATION         = ['type_id'=>3, 'name'=>'support', 'type'=>'','subject'=>'','body_template'=>''];
    const WELCOME_USER_NOTIFICATION             = [
        'type_id'   => 4,
        'type'              => 'welcome_user',
        'subject'           => 'Welcome to subscribe me!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const TEST_NOTIFICATION = [
        'type_id'           => 999,
        'type'              => 'test',
        'subject'           => 'This is a test subject!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];
//    const SUPPORT_NOTIFICATON          = ['type_id'=>3, 'name'=>'WELCOME_USER'];
//    const NEW_SUBSCRIPTION_TYPE = 2;
//    const SUPPORT               = 4;
//    const CONFIRM_ACCOUNT_TYPE  = 1;
//    const NEW_SUBSCRIPTION_TYPE = 2;
//    const NEW_USER_TYPE         = 3;
//    const SUPPORT               = 4;
    /** email types */


    public function getNotifications($type = null, $email = null, $id = null)
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
        $this->body = $request->get('body_template');
        $this->save();
        
    }

    public function sendNotification(Request $request = null, User $user, $notificationType)
    {
        if($notificationType == self::WELCOME_USER_NOTIFICATION['type_id']) {
            $this->type                 = self::WELCOME_USER_NOTIFICATION['type'];
            $this->subject              = self::WELCOME_USER_NOTIFICATION['subject'];
            $this->is_template          = true;
            $this->body_template        = self::WELCOME_USER_NOTIFICATION['body_template']; // template?
            $this->recipient_id         = Auth::id();
            return $this->save();
            

        } elseif ($notificationType == self::SUPPORT_NOTIFICATION['type_id']) {
            $this->type         = $request->get('type');
            $this->recipient_id = $request->get('recipient_id') ?: 0;
            $this->subject      = $request->get('subject');
            $this->body         = $request->get('body_template');
            $this->save(); // sends to us
            
            $userNotification           = new Notification(); // sends to the user 
            $userNotification->type     = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['type'];
            $userNotification->subject  = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['subject'];
            $userNotification->body     = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['body_template'];
            $userNotification->recipient_id = Auth::id();

            return $userNotification->save();;
        }
        return false;
    }


    public function getNotfication($notificationId)
    {
        $notification = Notification::find($notificationId);
        return $notification;
    }

    public function renderNotificationView($notificationType)
    {
        if($notificationType == self::WELCOME_USER_NOTIFICATION['type']) {
            return view($this->body_template)->with('user', Auth::user());
        }

        return false;

    }

//    public function update($notificationId) {
//
//    }

//    public function delete($notificationId) {
//        $notification = new Notification();
//        return $notification->delete();
//    }
}
