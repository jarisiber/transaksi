<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'departemen' => 'required|string|min:2|max:65535',
            'email_notification' => 'required|email|max:65535',
            'priority' => 'required|string|min:1|max:65535',
            'branch' => 'required|string|min:2|max:65535',
            'jenis_dukungan' => 'required|string|min:2|max:65535',
            'judul' => 'required|string|min:2|max:65535',
            'description' => 'required|string|min:2|max:65535',
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
            'email_notification.required' => 'Kolom email notifikasi wajib diisi!',
            'email_notification.email' => 'Kolom email notifikasi harus berupa email yang valid!',
            'email_notification.max' => 'Kolom email notifikasi maksimal :max karakter!',
            
            'departemen.required' => 'Kolom departemen wajib diisi!',
            'departemen.string' => 'Kolom departemen harus berupa karakter!',
            'departemen.min' => 'Kolom departemen minimal :min karakter!',
            'departemen.max' => 'Kolom departemen maksimal :max karakter!',

            'priority.required' => 'Kolom priority wajib diisi!',
            'priority.string' => 'Kolom priority harus berupa karakter!',
            'priority.min' => 'Kolom priority minimal :min karakter!',
            'priority.max' => 'Kolom priority maksimal :max karakter!',

            'branch.required' => 'Kolom branch wajib diisi!',
            'branch.string' => 'Kolom branch harus berupa karakter!',
            'branch.min' => 'Kolom branch minimal :min karakter!',
            'branch.max' => 'Kolom branch maksimal :max karakter!',

            'jenis_dukungan.required' => 'Kolom jenis dukungan wajib diisi!',
            'jenis_dukungan.string' => 'Kolom jenis dukungan harus berupa karakter!',
            'jenis_dukungan.min' => 'Kolom jenis dukungan minimal :min karakter!',
            'jenis_dukungan.max' => 'Kolom jenis dukungan maksimal :max karakter!',

            'judul.required' => 'Kolom judul wajib diisi!',
            'judul.string' => 'Kolom judul harus berupa karakter!',
            'judul.min' => 'Kolom judul minimal :min karakter!',
            'judul.max' => 'Kolom judul maksimal :max karakter!',

            'description.required' => 'Kolom keterangan wajib diisi!',
            'description.string' => 'Kolom keterangan harus berupa karakter!',
            'description.min' => 'Kolom keterangan minimal :min karakter!',
            'description.max' => 'Kolom keterangan maksimal :max karakter!',


        ];
    }
}
