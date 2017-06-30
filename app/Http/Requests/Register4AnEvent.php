<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register4AnEvent extends FormRequest
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
            'event_id' => 'required|integer',
            'event_type' => 'required|in:Event,Tradeshow',
            'senderName' => 'required|min:6',
            'senderEmail' => 'required|email',
            'senderPhone' => 'required|min:9',
            //'senderPhone.required|min:9' => 'Your phone number is required and it should be at least 9 characters long',
            'senderCompany' => 'nullable',
        ];
    }
}
