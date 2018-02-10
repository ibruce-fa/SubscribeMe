<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class NotificationController extends Controller
{
    public function create(Request $request) {
        $notification = new Notification();
        $notification->type = $request->get('type');
        $notification->receiver_id = $request->get('receiver_id');
        $notification->subject = $request->get('subject');
        $notification->body = $request->get('body');
    }

    public function get($notificationId){
        $notification = Notification::find($notificationId);
        return $notification;
    }

    public function update($notificationId) {

    }

    public function delete($notificationId) {
        $notification = new Notification();
        return $notification->delete();
    }
}
