<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string|min:2|max:100",
            "title" => "required|string|min:2|max:100",
            "about" => "required|string|min:2|max:250",
            "mobile" => "required|string",
            "phone" => "string",
            "address" => "required|string|min:2|max:250",
            "city" => "required|string|min:2|max:100",
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
