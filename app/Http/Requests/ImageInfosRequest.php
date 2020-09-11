<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageInfosRequest extends FormRequest
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
        $rules = [
            'infos' => 'required|max:500'
        ];

        if ($this->routeIs('update image infos')) {
            return $rules;
        }

        $rules['file'] = 'required|image|max:10240';

        return $rules;
    }
}
