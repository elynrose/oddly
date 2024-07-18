<?php

namespace App\Observers;

use App\Models\Job;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class JobActionObserver
{
    public function created(Job $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Job'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
