<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateEventOrTradeshow extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (auth()->check()) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'summary' => 'required|min:10',
            'description' => 'required|min:20',
            'event_type' => 'required|in:1,2',
            'new_event_image' => 'nullable|image',
            'event_host' => 'required|integer',
            'event_start_and_end_date' => 'required',
            'price' => 'required|integer',
            'availability' => 'required|in:limited,unlimited',
            'max_guest' => 'required|integer'
        ];
    }
}
