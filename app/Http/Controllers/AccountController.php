<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('account.account-home');
    }

    public function subscriptions()
    {
        $subscriptions  = Subscription::where('user_id', Auth::id())->where('business_id',"!=",0)->get();
        return view('account.subscriptions')->with('subscriptions', $subscriptions);
    }
    public function businessNotificationView($businessId){
        $businessEmail = (new Business())->where('id', $businessId)->value('email');
        $notifications = (new Notification())->getNotifications('business', $businessEmail, $businessId);
        return view('business.business-notifications')->with('notifications', $notifications);
    }

    public function accountNotificationView(){
        $notifications = (new Notification())->getNotifications('consumer', Auth::user()->email);
        // maybe also get common
        return view('account.account-notifications')->with('notifications', $notifications);
    }

    public function deleteAccount(){
        // maybe also get common
        return view('account.delete-account');
    }

    public function showSupportView(){
        // maybe also get common
        return view('account.support');
    }

}
