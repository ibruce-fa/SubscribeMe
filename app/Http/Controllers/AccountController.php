<?php

namespace App\Http\Controllers;

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
    public function accountNotificationView($businessId){
        $businessEmail = (new Business())->where('id', $businessId)->value('email');
        $notifications = (new Notification())->getNotifications('business', $businessEmail, $businessId);
        return view('business.business-notifications')->with('notifications', $notifications);
    }

}
