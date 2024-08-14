<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\IsValidPassword;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function onCreate()
    {
        return [
            'first_name' => ['required', 'string'], 
            'last_name' => ['required', 'string'],
            'salary' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:png,jpg', 'max:1024'],
            'phone' => ['required', 'string','max:255', 'regex:/^01[0-9]{9}$/','unique:users,phone'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'department_id' => ['required', 'numeric', 'exists:departments,id','not_in:0'],
            'password' => ['required', 'confirmed',new IsValidPassword()],
        ];
    }

    protected function onUpdate()
    {
        return [
            'first_name' => ['required', 'string'], 
            'last_name' => ['required', 'string'],
            'salary' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg', 'max:1024'],
            'phone' => ['required', 'string','max:255', 'regex:/^01[0-9]{9}$/','unique:users,phone,'.$this->employee->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->employee->id],
            'department_id' => ['required', 'numeric', 'exists:departments,id','not_in:0'],
            'password' => ['nullable', 'confirmed',new IsValidPassword()],
            // 'password' => $this->password ? ['string', new IsValidPassword()] : '',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->isMethod('put') ? $this->onUpdate() : $this->onCreate();
    }
}
