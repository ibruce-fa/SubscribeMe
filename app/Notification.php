<?php

namespace App;

use App\Mail\ConfirmAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Notification extends Model
{
    /** CONSUMER notification types */

    const WELCOME_USER_NOTIFICATION         = [ // done
        'type'              => 'welcome_user',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const SUBSCRIBE_USER_NOTIFICATION         = [ //  in progress
        'type'              => 'subscribe_user',
        'subject'           => 'New Subscription to ', // concatenate Company name at the end
        'body_template'     => 'notifications.templates.subscribe-user' // body will be a template of some sort
    ];

    const UNSUBSCRIBE_USER_NOTIFICATION         = [
        'type'              => 'unsubscribe_user',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const NOTIFY_PLAN_DELETION_NOTIFICATION         = [
        'type'              => 'notify_plan_deletion',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const NOTIFY_PLAN_MODIFICATION_NOTIFICATION         = [
        'type'              => 'notify_plan_modification',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const NOTIFY_BUSINESS_DELETION_NOTIFICATION         = [
        'type'              => 'notify_business_deletion',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const NOTIFY_BUSINESS_MODIFICATION_NOTIFICATION         = [
        'type'              => 'notify_business_modification',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const BUSINESS_TO_USERS_NOTIFICATION         = [
        'type'              => 'business_to_users',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const PAYMENT_UNSUCCESSFUL_NOTIFICATION         = [
        'type'              => 'payment_unsuccessful',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const ALL_USERS_NOTIFICATION         = [
        'type'              => 'welcome_user',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const USER_FAREWELL_NOTIFICATION         = [
        'type'              => 'welcome_user',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    /** CONSUMER notification types END */

    const WELCOME_BUSINESS_NOTIFICATION     = [
        'type'              => 'welcome_business',
        'subject'           => 'Congrats! now sell some subscriptions',
        'body_template'     => 'notifications.templates.welcome-business' // body will be a template of some sort
    ];

    const SUPPORT_ACKNOWLEDGE_NOTIFICATION  = [
        'type'              => 'support_acknowledge',
        'subject'           => 'Otruvez Support',
        'body_template'     => 'notifications.templates.support-acknowledge'
    ];

    const SUPPORT_RESPONSE_NOTIFICATION     = [
        'type_id'           => 3,
        'type'              => 'support_acknowledge',
        'subject'           => 'Otruvez Support',
        'body_template'     => 'notifications.templates.support-acknowledge'
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


    public function getNotifications($id = null)
    {
        return $this->where('recipient_id', $id)->whereNull('business_id')->orderBy('id', 'desc')->get();
    }

    public function getBusinessNotifications($businessId)
    {
        return $this->where('business_id', $businessId)->orderBy('id', 'desc')->get();
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

        if($notificationType == self::WELCOME_BUSINESS_NOTIFICATION['type']) {
            return view($this->body_template);
        }

        return false;

    }

    public function sendWelcomeNotification($user)
    {
        $this->type                 = self::WELCOME_USER_NOTIFICATION['type'];
        $this->sender_name          = env('APP_NAME');
        $this->subject              = self::WELCOME_USER_NOTIFICATION['subject'];
        $this->is_template          = true;
        $this->body_template        = self::WELCOME_USER_NOTIFICATION['body_template']; // template?
        $this->recipient_id         = $user->id;
        return $this->save();
    }

    public function sendBusinessWelcomeNotification($user, $business)
    {
        $this->type                 = self::WELCOME_BUSINESS_NOTIFICATION['type'];
        $this->sender_name          = env('APP_NAME');
        $this->subject              = self::WELCOME_BUSINESS_NOTIFICATION['subject'];
        $this->is_template          = true;
        $this->body_template        = self::WELCOME_BUSINESS_NOTIFICATION['body_template']; // template?
        $this->recipient_id         = $user->id;
        $this->business_id          = $business->id;
        return $this->save();
    }

    public function sendSupportNotification(Request $request)
    {
        $this->type         = $request->get('type');
        $this->recipient_id = "0";
        $this->subject      = $request->get('subject');
        $this->body         = $request->get('body');
        $this->save(); // sends to us

        $userNotification               = new Notification(); // sends to the user
        $userNotification->type         = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['type'];
        $userNotification->subject      = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['subject'];
        $userNotification->body         = self::SUPPORT_ACKNOWLEDGE_NOTIFICATION['body_template'];
        $userNotification->recipient_id = Auth::id();

        return $userNotification->save();
    }

    public function completeSubject($str1, $str2) {
        return sprintf('%s%s',$str1, $str2);
    }

}
