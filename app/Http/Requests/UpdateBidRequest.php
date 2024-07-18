<?php

namespace App\Http\Requests;

use App\Models\Bid;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBidRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bid_edit');
    }

    public function rules()
    {
        return [
            'job_id' => [
                'required',
                'integer',
            ],
            'points_required' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
