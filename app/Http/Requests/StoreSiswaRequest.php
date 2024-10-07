<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'nis' => 'required|string|max:255|unique:siswa,nis',
        'password' => 'nullable|min:8', // Hanya validasi jika ingin mengubah password
        'kelas' => 'required|string|max:255',
        'alamat' => 'required|string',
        'divisi_id' => 'required|exists:divisi,id',
        'role_id' => 'required|exists:roles,id',
    ];
}


}
