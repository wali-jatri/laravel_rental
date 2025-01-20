<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        // You can conditionally define the rules based on the action
        if ($this->isMethod('post') && $this->routeIs('user.register')) {
            // User registration rules
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
            ];
        }

        if ($this->isMethod('post') && $this->routeIs('user.login')) {
            // User login rules
            return [
                'email' => 'required|email|exists:users',
                'password' => 'required',
            ];
        }

        if ($this->isMethod('post') && $this->routeIs('partner.register')) {
            // Partner registration rules
            return [
                'name' => 'required|string|max:255',
                'contact_number' => 'required|string|max:255|unique:partners',
                'password' => 'required|string|min:6|confirmed',
            ];
        }

        if ($this->isMethod('post') && $this->routeIs('partner.login')) {
            // Partner login rules
            return [
                'contact_number' => 'required|string|exists:partners',
                'password' => 'required',
            ];
        }

        return [];
    }
}
