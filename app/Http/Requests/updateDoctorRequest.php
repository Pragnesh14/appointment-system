<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class  updateDoctorRequest extends FormRequest
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
            // 'name' => 'required',
            // 'email' => 'required|unique:users,email',

            // 'gender' => 'required',
            // 'education' => 'required',
            // 'address' => 'required',
            // 'department' => 'required',
            // 'phone_number' => 'required|numeric',
            // 'image' => 'mimes:jpeg,jpg,png',
            // 'role_id' => 'required',
            // 'description' => 'required'
        ];
    }
}
