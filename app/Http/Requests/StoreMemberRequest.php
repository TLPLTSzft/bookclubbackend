<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $gender = ['', 'm', 'f', 'M', 'F'];
        return [
            'name' => 'required|string',
            'gender' => 'nullable|in: ' . implode(',', $gender),
            'birth_date' => 'required|date',
        ];
    }
}
