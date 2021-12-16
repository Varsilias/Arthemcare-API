<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            "firstname" => "required|string|between:2,100",
			"lastname" => "required|string|between:2,100",
			"DOB" => "required|string",
			"phone_number" => "required|string",
			"complexion" => "required|string",
			"gender" => "required|string",
			"ward_no" => "required|string",
        ];
    }
}
