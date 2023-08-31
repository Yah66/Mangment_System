<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function Laravel\Prompts\note;

class GradeRequest extends FormRequest
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
        return [
            'name' => 'required',
            'name_en' => 'required',
            'note' => 'nullable',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),

        ];
    }
}
