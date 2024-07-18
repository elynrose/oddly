<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'category_create',
            ],
            [
                'id'    => 18,
                'title' => 'category_edit',
            ],
            [
                'id'    => 19,
                'title' => 'category_show',
            ],
            [
                'id'    => 20,
                'title' => 'category_delete',
            ],
            [
                'id'    => 21,
                'title' => 'category_access',
            ],
            [
                'id'    => 22,
                'title' => 'job_create',
            ],
            [
                'id'    => 23,
                'title' => 'job_edit',
            ],
            [
                'id'    => 24,
                'title' => 'job_show',
            ],
            [
                'id'    => 25,
                'title' => 'job_delete',
            ],
            [
                'id'    => 26,
                'title' => 'job_access',
            ],
            [
                'id'    => 27,
                'title' => 'budget_create',
            ],
            [
                'id'    => 28,
                'title' => 'budget_edit',
            ],
            [
                'id'    => 29,
                'title' => 'budget_show',
            ],
            [
                'id'    => 30,
                'title' => 'budget_delete',
            ],
            [
                'id'    => 31,
                'title' => 'budget_access',
            ],
            [
                'id'    => 32,
                'title' => 'bid_create',
            ],
            [
                'id'    => 33,
                'title' => 'bid_edit',
            ],
            [
                'id'    => 34,
                'title' => 'bid_show',
            ],
            [
                'id'    => 35,
                'title' => 'bid_delete',
            ],
            [
                'id'    => 36,
                'title' => 'bid_access',
            ],
            [
                'id'    => 37,
                'title' => 'review_create',
            ],
            [
                'id'    => 38,
                'title' => 'review_edit',
            ],
            [
                'id'    => 39,
                'title' => 'review_show',
            ],
            [
                'id'    => 40,
                'title' => 'review_delete',
            ],
            [
                'id'    => 41,
                'title' => 'review_access',
            ],
            [
                'id'    => 42,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 43,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 44,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 45,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 46,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 47,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 48,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 49,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 50,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 51,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 52,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 53,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 54,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 55,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 56,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 57,
                'title' => 'task_create',
            ],
            [
                'id'    => 58,
                'title' => 'task_edit',
            ],
            [
                'id'    => 59,
                'title' => 'task_show',
            ],
            [
                'id'    => 60,
                'title' => 'task_delete',
            ],
            [
                'id'    => 61,
                'title' => 'task_access',
            ],
            [
                'id'    => 62,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 63,
                'title' => 'payment_create',
            ],
            [
                'id'    => 64,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 65,
                'title' => 'payment_show',
            ],
            [
                'id'    => 66,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 67,
                'title' => 'payment_access',
            ],
            [
                'id'    => 68,
                'title' => 'package_create',
            ],
            [
                'id'    => 69,
                'title' => 'package_edit',
            ],
            [
                'id'    => 70,
                'title' => 'package_show',
            ],
            [
                'id'    => 71,
                'title' => 'package_delete',
            ],
            [
                'id'    => 72,
                'title' => 'package_access',
            ],
            [
                'id'    => 73,
                'title' => 'credit_create',
            ],
            [
                'id'    => 74,
                'title' => 'credit_edit',
            ],
            [
                'id'    => 75,
                'title' => 'credit_show',
            ],
            [
                'id'    => 76,
                'title' => 'credit_delete',
            ],
            [
                'id'    => 77,
                'title' => 'credit_access',
            ],
            [
                'id'    => 78,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
