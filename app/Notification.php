<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function getNotifications($type, $email = null, $id = null)
    {
        return $this->where('type', $type)
                    ->where('recipient_email', $email)
                    ->orWhere('recipient_id', $id)
                    ->get();
    }
}
