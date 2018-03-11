<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

class UserController extends Controller
{

    public function activateBusinessAccount($id, $accountPlan, $subscriptionId)
    {
        $user = $this->findUser($id);
        if ($user)
        {
            $user->business_account = "1";
            $user->business_account_plan = $accountPlan;
            $user->subscription_id = $subscriptionId;
            $user->save();
            return $user;
        }

        return 'success';

    }

    public function activateUserAccount(Request $request)
    {
        $user = (new User())->where('email', $request->query('email'))->first();

        if($user && $user->activated == 0 && $user->activation_token == $request->query('token')) {
            $user->activated = "1";
            $user->save();
            $notification = new Notification();
            $notification->sendWelcomeNotification($user);
            return redirect('/login')->with('successMessage', "Your account has been activated! please log in");
        } elseif($user->activated == 1) {
            return redirect('/login')->with('warningMessage', "This link has expired");
        } else {
            return redirect('/login')->with('errorMessage', "Corrupted link");
        }
    }

    public function updateBusinessAccount($id, $accountPlan = null)
    {
        $user = $this->findUser($id);
        if ($user)
        {
            $user->business_account = "1";
            $user->business_account_plan = $accountPlan;
            $user->save();
            return $user;
        }

        return 'success';

    }

    public function test(Request $request) {
        $notification = new Notification();
        $user = User::find(Auth::id());
        $notification->sendNotification($request, $user, Notification::WELCOME_USER_NOTIFICATION['type_id']);
        return redirect('/account')->with('successMessage','Notification sent successfully');
    }

    private function getUserObject()
    {
        return new User;
    }
    public function findUser($id)
    {
        return $this->getUserObject()->find($id);
    }
}
