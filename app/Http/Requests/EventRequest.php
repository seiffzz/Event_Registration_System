<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed event_image
 * @property mixed event_name
 * @property mixed event_price
 * @property mixed event_capacity
 * @property mixed event_location
 * @property mixed event_time
 */
class EventRequest extends FormRequest
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
            'event_name'=>'required',
            'event_price'=>'required|numeric',
            'event_capacity'=>'required|numeric',
            'event_time'=>'required',
            'event_location'=>'required|starts_with:https://goo.gl/maps/',
            'event_image'=>'required'
        ];
    }
    public function messages()
    {
        return [
          'event_location.starts_with'=>'Please Enter a valid google maps link.'
        ];

    }
}
