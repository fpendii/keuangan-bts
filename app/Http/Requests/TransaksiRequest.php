<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_pelanggan' => 'required|string|max:255',
            'nama_dokument' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'jumlah' => 'required|numeric|min:1',
        ];


    }

    public function messages()
{
    return [
        'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
        'nama_pelanggan.max' => 'Nama pelanggan tidak boleh lebih dari 255 karakter.',
        'nama_dokument.mimes' => 'Dokumen harus berupa file dengan format PDF, Word, Excel, atau PowerPoint.',
        'jumlah.required' => 'Total harga harus diisi.',
        'jumlah.numeric' => 'Total harga harus berupa angka.',
        'jumlah.min' => 'Total harga minimal adalah 1.',
    ];
}
}
