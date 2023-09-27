<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'max:20'],
            'password' => ['required', 'max:20'],
        ];
    }

    public function messages()
    {
        return [
            'email.required'    =>  'EMAIL을 입력해 주십시오.',
            'email.max'         =>  'EMAIL은 최대 20문자까지 입력할 수 있습니다.',
            'password.required' =>  'PASSWORD를 입력해 주십시오.',
            'password.max'      =>  'PASSWORD는 최대 20문자까지 입력할 수 있습니다.'
        ];
    }
}
