<?php

namespace App\Http\Requests;

use App\Models\Budget;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBudgetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('budget_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'ordering' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
