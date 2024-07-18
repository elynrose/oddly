<?php

namespace App\Observers;

use App\Models\Review;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class ReviewActionObserver
{
    public function created(Review $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Review'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
