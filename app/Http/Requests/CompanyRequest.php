<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            $email_rules = 'nullable|max:255|email|unique:companies,email,' .$this->route('company');
        }

        else
        {
            $email_rules = 'nullable|max:255|email|unique:companies,email';
        }
        return
            [
                'name' => 'required|string|min:3|max:200',
                'email' => $email_rules,
                'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:width=100,height=100',
                'website' => 'nullable|url|max:255',
            ];
    }

}
