<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTag extends FormRequest
{
    /**
     * Tag routes are wrapped in Auth middleware, and that's all that's required.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                // don't let a user have tags with same name,
                // but others might have tags with same name.
                Rule::unique('tags')->where(function ($query) {
                    $query->where('created_by_user_id', $this->user()->id);
                }),
            ],
        ];
    }
}
