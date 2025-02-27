<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_create');
    }

    public function rules()
    {
        return [
            'job_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'due_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
