<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('client-update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
         //    'name' => 'required',
         //    'email' => 'required|email',
         //    'city' => 'required',
         //    'state_id' => 'required',
        	// 'primary_number' => 'numeric',
         //    'user_id' => 'required',
        	// 'source_type'=>'required',
        	// 'source_id' => 'required'
        ];
    }
}
