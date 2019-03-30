<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'title' => 'required|max:250',
            'parts.*.title' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'You must enter series title!',
            'parts.*.title.required' => 'You need to give to this part a title!'
        ];
    }
}
