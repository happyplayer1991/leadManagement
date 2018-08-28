<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return auth()->user()->can('lead-create');
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
            // 'title' => '',
            // 'note' => '',
            // 'status' => '',
            // 'user_assigned_id' => '',
            // 'user_created_id' => '',
            // 'client_id' => '',
            // 'contact_date' => ''
        ];
    }
}
