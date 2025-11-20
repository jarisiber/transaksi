<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePesanRequest extends FormRequest
{
    protected $errorBag = 'store';

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
            // 'to_user_id' => 'required|string|min:1|max:65535',
            'subject' => 'required|string|min:3|max:255',
            'message_text' => 'required|string|min:2|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // 'to_user_id.required' => 'Kolom to_user_id wajib diisi!',
            // 'to_user_id.string' => 'Kolom to_user_id harus berupa karakter!',
            // 'to_user_id.min' => 'Kolom to_user_id minimal :min karakter!',
            // 'to_user_id.max' => 'Kolom to_user_id maksimal :max karakter!',

            // 'subject.required' => 'Kolom subject wajib diisi!',
            // 'subject.string' => 'Kolom subject harus berupa karakter!',
            // 'subject.min' => 'Kolom subject minimal :min karakter!',
            // 'subject.max' => 'Kolom subject maksimal :max karakter!',

            'message_text.required' => 'Kolom nama message_text wajib diisi!',
            'message_text.string' => 'Kolom nama message_text harus berupa karakter!',
            'message_text.min' => 'Kolom nama message_text minimal :min karakter!',
            'message_text.max' => 'Kolom nama message_text maksimal :max karakter!',
        ];
    }
}
