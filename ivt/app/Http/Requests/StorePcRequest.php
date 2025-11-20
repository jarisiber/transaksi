<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePcRequest extends FormRequest
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
            'jenis' => 'required|string|min:3|max:255',
            'branch_name' => 'required|string|min:2|max:255',
            'user_responsible' => 'required|string|min:2|max:255',
            'hostname' => 'required|string|min:2|max:255',
            'merk' => 'required|string|min:2|max:255',
            'processor' => 'required|string|min:2|max:255',
            'ram' => 'required|numeric|digits_between:1,10',
            'keterangan' => 'nullable|string|min:3|max:1000',
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
            'jenis.required' => 'Kolom jenis wajib diisi!',
            'jenis.string' => 'Kolom jenis harus berupa karakter!',
            'jenis.min' => 'Kolom jenis minimal :min karakter!',
            'jenis.max' => 'Kolom jenis maksimal :max karakter!',

            'branch_name.required' => 'Kolom nama branch wajib diisi!',
            'branch_name.string' => 'Kolom nama branch harus berupa karakter!',
            'branch_name.min' => 'Kolom nama branch minimal :min karakter!',
            'branch_name.max' => 'Kolom nama branch maksimal :max karakter!',

            'user_responsible.required' => 'Kolom user responsible wajib diisi!',
            'user_responsible.string' => 'Kolom user responsible harus berupa karakter!',
            'user_responsible.min' => 'Kolom user responsible minimal :min karakter!',
            'user_responsible.max' => 'Kolom user responsible maksimal :max karakter!',

            'hostname.required' => 'Kolom hostname wajib diisi!',
            'hostname.string' => 'Kolom hostname harus berupa karakter!',
            'hostname.min' => 'Kolom hostname minimal :min karakter!',
            'hostname.max' => 'Kolom hostname maksimal :max karakter!',

            'merk.required' => 'Kolom merek wajib diisi!',
            'merk.string' => 'Kolom merek harus berupa karakter!',
            'merk.min' => 'Kolom merek minimal :min karakter!',
            'merk.max' => 'Kolom merek maksimal :max karakter!',

            'processor.required' => 'Kolom processor wajib diisi!',
            'processor.string' => 'Kolom processor harus berupa karakter!',
            'processor.min' => 'Kolom processor minimal :min karakter!',
            'processor.max' => 'Kolom processor maksimal :max karakter!',

            'ram.required' => 'Kolom RAM wajib diisi!',
            'ram.numeric' => 'Kolom RAM harus berupa angka!',
            'ram.digits_between' => 'Kolom RAM harus diantara :min sampai :max digit!',

            'keterangan.string' => 'Kolom keterangan harus berupa karakter!',
            'keterangan.min' => 'Kolom keterangan minimal :min karakter!',
            'keterangan.max' => 'Kolom keterangan maksimal :max karakter!',

        ];
    }
}
