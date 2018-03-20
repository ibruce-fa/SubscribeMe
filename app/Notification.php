<?php

namespace App;

use App\Mail\ConfirmAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Plan;
use App\Business;

class Notification extends Model
{
    /** CONSUMER notification types */

    const WELCOME_USER_NOTIFICATION             = [ // done
        'type'              => 'welcome_user',
        'subject'           => 'Welcome to Otruvez!',
        'body_template'     => 'notifications.templates.welcome-user' // body will be a template of some sort
    ];

    const SUBSCRIBED_USER_NOTIFICATION           = [ //  done for USER but need flash notification for businesses
        'type'              => 'subscribed_user',
        'subject'           => 'You have a new subscription!', // concatenate Company name at the end
        'body_template'     => 'notifications.templates.subscribed-user' // body will be a template of some sort
    ];

    const UNSUBSCRIBED_USER_NOTIFICATION         = [ // done
        'type'              => 'unsubscribed_user',
        'subject'           => 'Confirmation: Canceled subscription',
        'body_template'     => 'notifications.templates.unsubscribed-user' // body will be a template of some sort
    ];

    const NOTIFY_PLAN_DELETION_NOTIFICATION         = [ // done
        'type'              => 'notify_plan_deletion',
        'subject'           => "Subscription canceled. Service no longer available",
        'body_template'     => 'notifications.templates.notify-plan-deletion' // body will be a template of some sort
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

    public function renderNotificationView($notificationType, $data = [])
    {
        if($notificationType == self::WELCOME_USER_NOTIFICATION['type']) {
            return view($this->body_template)->with(['user' => Auth::user()]);
        }

        if($notificationType == self::WELCOME_BUSINESS_NOTIFICATION['type']) {
            return view($this->body_template);
        }

        if($notificationType == self::SUBSCRIBED_USER_NOTIFICATION['type']) {
            $subscription       = Subscription::find($data['subscriptionId']);
            $plan               = Plan::find($subscription->plan_id);
            $business           = Business::find($subscription->business_id);

            return view($this->body_template)->with([
                'companyName'       => $business->name,
                'interval'          => $subscription->o_interval,
                'price'             => formatPrice($subscription->price),
                'usageDescription'  => getUseLimitString($plan),
                'serviceName'       => $plan->stripe_plan_name,
                'description'       => $plan->description,
                'logoPath'          => $business->logo_path ?: ''// html
            ]);
        }

        if($notificationType == self::UNSUBSCRIBED_USER_NOTIFICATION['type']) {
            $subscription       = Subscription::find($data['subscriptionId']);
            $plan               = Plan::find($subscription->plan_id);
            $business           = Business::find($subscription->business_id);

            return view($this->body_template)->with([
                'companyName'       => $business->name,
                'serviceName'       => $plan->stripe_plan_name,
                'confirmationId'    => $subscription->stripe_id,
                'logoPath'          => $business->logo_path ?: ''// html
            ]);
        }

        if($notificationType == self::NOTIFY_PLAN_DELETION_NOTIFICATION['type']) {
            $subscription       = Subscription::find($data['subscriptionId']);
            $plan               = Plan::find($subscription->plan_id);
            $business           = Business::find($subscription->business_id);
            $refund             = $data['refund'];

            return view($this->body_template)->with([
                'companyName'       => $business->name,
                'serviceName'       => $plan->stripe_plan_name,
                'confirmationId'    => $subscription->stripe_id,
                'refund'            => $refund,
                'logoPath'          => $business->logo_path ?: ''// html
            ]);
        }

        return false;

    }

    public function sendWelcomeNotification($user)
    {
        $this->type                 = self::WELCOME_USER_NOTIFICATION['type'];
        $this->subject              = self::WELCOME_USER_NOTIFICATION['subject'];
        $this->body_template        = self::WELCOME_USER_NOTIFICATION['body_template']; // template?
        $this->sender_name          = env('APP_NAME');
        $this->is_template          = true;
        $this->recipient_id         = $user->id;
        return $this->save();
    }

    public function sendSubscribedUserNotification($user, $business, $subscription)
    {
        $this->type                 = self::SUBSCRIBED_USER_NOTIFICATION['type'];
        $this->body_template        = self::SUBSCRIBED_USER_NOTIFICATION['body_template']; // template?
        $this->subject              = self::SUBSCRIBED_USER_NOTIFICATION['subject'];
        $this->sender_name          = $business->name;
        $this->is_template          = true;
        $this->recipient_id         = $user->id;
        $this->subscription_id      = $subscription->id;
        return $this->save();
    }

    public function sendUnsubscribedUserNotification($user, $business, $subscription)
    {
        $this->type                 = self::UNSUBSCRIBED_USER_NOTIFICATION['type'];
        $this->body_template        = self::UNSUBSCRIBED_USER_NOTIFICATION['body_template'];
        $this->body                 = $this->renderNotificationView(self::UNSUBSCRIBED_USER_NOTIFICATION['type'],['subscriptionId' => $subscription->id])->render(); // template?
        $this->subject              = self::UNSUBSCRIBED_USER_NOTIFICATION['subject'];
        $this->sender_name          = $business->name;
        $this->is_template          = "0";
        $this->recipient_id         = $user->id;
        $this->subscription_id      = $subscription->id;
        return $this->save();
    }

    public function sendNotifyPlanDeletionNotification($user, $business, $subscription)
    {
        $this->type                 = self::NOTIFY_PLAN_DELETION_NOTIFICATION['type'];
        $this->body_template        = self::NOTIFY_PLAN_DELETION_NOTIFICATION['body_template'];
        // the REFUND status will need to be worked out stills
        $this->body                 = $this->renderNotificationView(self::NOTIFY_PLAN_DELETION_NOTIFICATION['type'],['subscriptionId' => $subscription->id,'refund' => true])->render(); // template?
        $this->subject              = self::NOTIFY_PLAN_DELETION_NOTIFICATION['subject'];
        $this->sender_name          = $business->name;
        $this->is_template          = "0";
        $this->recipient_id         = $subscription->user_id;
        $this->subscription_id      = $subscription->id;
        return $this->save();
    }

    public function sendBusinessWelcomeNotification($user, $business)
    {
        $this->type                 = self::WELCOME_BUSINESS_NOTIFICATION['type'];
        $this->subject              = self::WELCOME_BUSINESS_NOTIFICATION['subject'];
        $this->body_template        = self::WELCOME_BUSINESS_NOTIFICATION['body_template']; // template?
        $this->sender_name          = env('APP_NAME');
        $this->is_template          = true;
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
