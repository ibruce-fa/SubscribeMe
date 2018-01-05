<?php

namespace App\Http\Controllers;

use App\Business;
use App\CheckIn;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function createCheckIn(Request $request)
    {
        $newCheckIn = new CheckIn($request->all());
        $business = $this->getBusinessObject()->find($request->business_id);
        $business->getCheckIns->save($newCheckIn);
    }

    public function confirmCheckIn($id)
    {
        $checkIn = $this->getCheckInObject()->find($id);
        $checkIn->status = "1";
        $checkIn->save();
    }

    public function deleteCheckIn($id)
    {
        $checkIn = $this->getCheckInObject()->find($id);
        $checkIn->delete();
    }

    public function getBusinessObject()
    {
        return new Business;
    }

    public function getCheckInObject()
    {
        return new CheckIn;
    }

}
