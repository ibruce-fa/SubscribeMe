<?php

// NOT NEEDED. HANDLED IN THE SUBSCRIPTION CONTROLLER
//









//namespace App\Http\Controllers;
//
//use App\Business;
//use App\CheckIn;
//use App\Subscription;
//use Faker\Provider\DateTime;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class CheckInController extends Controller
//{
//    public function createCheckIn(Request $request)
//    {
//        $newCheckIn = new CheckIn($request->all());
//        $business = $this->getBusinessObject()->find($request->business_id);
//        $business->getCheckIns->save($newCheckIn);
//    }
//
//    public function confirmCheckIn($id)
//    {
//        $checkIn = $this->getCheckInObject()->find($id);
//        $checkIn->status = "1";
//        $checkIn->save();
//    }
//
//    public function deleteCheckIn($id)
//    {
//        $checkIn = $this->getCheckInObject()->find($id);
//        $checkIn->delete();
//    }
//
//    public function getBusinessObject()
//    {
//        return new Business;
//    }
//
//    public function getCheckInObject()
//    {
//        return new CheckIn;
//    }
//
//    public function initCheckin(Request $request, $subscriptionId)
//    {
//        // checkin will already be created upon subscription
//        // find checkin
//        $date = new \DateTime('now');
//        $currentDate = sprintf("%s%s",$date->format('m'),$date->format('Y'));
//        $subscription = Subscription::find($subscriptionId);
//        if(!($subscription->last_usage_date == $currentDate)) // if the last checkin date of the subscription is behind the current date, we can do a fresh checkin, else we need to check their privileges
//        {
//            // fresh checkin
//            // reset their "uses"
//            // update their code
//        } else {
//
//        }
//        $checkin = CheckIn::where('user_id', Auth::id())->where('subscription _id', $subscriptionId)->first(); // si
//        $checkinCode = rand(10000,99999);
//
//
//    }
//
//
//}
