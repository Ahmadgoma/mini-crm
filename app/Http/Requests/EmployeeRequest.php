<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        // Check Create or Update
        if ($this->method() == 'PUT')
        {
            $email_rules = 'nullable|max:255|email|unique:employees,email,'. $this->route('employee');
            $phone_rules = 'nullable|integer|digits_between:11,17|unique:employees,phone,' .$this->route('employee');
        }

        else
        {
            $email_rules = 'nullable|max:255|email|unique:employees,email';
            $phone_rules = 'nullable|integer|digits_between:11,17|unique:employees,phone';
        }
        return
            [
                'first_name' => 'required|string|min:3|max:100',
                'last_name' => 'required|string|min:3|max:100',
                'email' => $email_rules,
                'company_id' => 'required|integer',
                'phone' => $phone_rules
            ];
    }

}
