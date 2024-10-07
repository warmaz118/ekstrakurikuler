<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('users')->ignore($this->route('siswa')->user_id),
        ],
        'nis' => [
            'required',
            'string',
            'max:255',
            Rule::unique('siswa')->ignore($this->route('siswa')->id),
        ],
        'password' => 'nullable|min:8', // Hanya validasi jika ingin mengubah password
        'kelas' => 'required|string|max:255',
        'alamat' => 'required|string',
        'divisi_id' => 'required|exists:divisi,id',
        'role_id' => 'required|exists:roles,id',
    ];
}
}
