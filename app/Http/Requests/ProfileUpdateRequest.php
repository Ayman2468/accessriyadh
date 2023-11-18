<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
    public function messages(): array
    {
        return [
            'name.string'=>__('validate.The name field can\'t be numbers'),
            'name.max'=>__('validate.The name field can\'t be longer than 255 character'),
            'email.email'=>__('validate.The email field must be a valid email address.'),
            'email.max'=>__('validate.The email field can\'t be longer than 255 character'),
            'email.unique'=>__('validate.This email used before'),
        ];
    }
}
