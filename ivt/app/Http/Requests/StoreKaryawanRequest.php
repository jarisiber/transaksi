<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKaryawanRequest extends FormRequest
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
            'first_name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:karyawans,email', 
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
            'first_name.required' => 'Kolom Nama wajib diisi!',
            'first_name.string' => 'Kolom Nama harus berupa karakter!',
            'first_name.min' => 'Kolom Nama minimal :min karakter!',
            'first_name.max' => 'Kolom Nama maksimal :max karakter!',
            
            'email.required' => 'Kolom Email wajib diisi!',
            'email.string' => 'Kolom Email harus berupa karakter!',
            'email.unique' => 'Email sudah terdaftar di sistem!',
        ];
    }
}
