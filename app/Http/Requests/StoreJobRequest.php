<?php

namespace App\Http\Requests;

use App\Models\Job;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'description' => [
                'required',
            ],
            'attachments' => [
                'array',
            ],
            'budget_id' => [
                'required',
                'integer',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
            'deadline' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'completed_files' => [
                'array',
            ],
            'completed_link' => [
                'string',
                'nullable',
            ],
            'job_code' => [
                'string',
                'required',
                'unique:jobs',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
