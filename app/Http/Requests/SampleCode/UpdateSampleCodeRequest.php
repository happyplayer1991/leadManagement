<?php

namespace App\Http\Requests\SampleCode;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSampleCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('administrator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'samplecode' => '',
            'itemcode' => '',
            'itemcodecolor' => '',
            'colorcode' => '',
            'colorcodecolor' => '',
            'briefdescription' => '',
            'image_path' => ''
        ];
    }
}
