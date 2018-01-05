<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('/user/user-home');
    }

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

    private function getUserObject()
    {
        return new User;
    }
    public function findUser($id)
    {
        return $this->getUserObject()->find($id);
    }
}
