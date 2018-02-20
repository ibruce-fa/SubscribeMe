<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Subscription;
use Exception;
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

    public function contactSupport(Request $request){
        try {
            (new Notification())->createNotification($request);
            return redirect('/account')->with('successMessage', "Your message was successfully sent. You will receive a response in 24-48 hours.");
        } catch (Exception $e) {
            // return with old values
            return redirect('/account/support')->with('errorMessage', "Message was not sent successfully. Please try again.");
        }

    }

    public function showDeleteAccountView(){
        // maybe also get common
        return view('account.delete-account');
    }

    public function deleteAccount()
    {
        // delete user
        // delete all subscriptions associated with user
        // if they have a business, then we have to run the deleteBusiness method
        // DELETE BUSINESS METHOD SHOULD BE CREATED FIRST BECAUSE OF 3RD POINT

    }

    public function showSupportView(){
        // maybe also get common
        return view('account.support');
    }

}
