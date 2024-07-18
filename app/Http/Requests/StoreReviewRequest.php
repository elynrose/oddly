<?php

namespace App\Http\Requests;

use App\Models\Review;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('review_create');
    }

    public function rules()
    {
        return [
            'job_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'rating' => [
                'required',
            ],
            'comment' => [
                'required',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
