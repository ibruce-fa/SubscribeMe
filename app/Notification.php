<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Notification extends Model
{
    public function getNotifications($type, $email = null, $id = null)
    {
        return $this->where('type', $type)
                    ->where('recipient_email', $email)
                    ->orWhere('recipient_id', $id)
                    ->get();
    }

    /** THIS CODE SHOULD BE IN THE MODEL */
    public function createNotification(Request $request) {
        $this->type = $request->get('type');
        $this->recipient_id = $request->get('recipient_id') ?: 0;
        $this->subject = $request->get('subject');
        $this->body = $request->get('body');
        $this->save();
    }

    public function getNotfication($notificationId){
        $notification = Notification::find($notificationId);
        return $notification;
    }

//    public function update($notificationId) {
//
//    }

//    public function delete($notificationId) {
//        $notification = new Notification();
//        return $notification->delete();
//    }
}
