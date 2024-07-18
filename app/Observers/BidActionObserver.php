<?php

namespace App\Observers;

use App\Models\Bid;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class BidActionObserver
{
    public function created(Bid $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Bid'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
