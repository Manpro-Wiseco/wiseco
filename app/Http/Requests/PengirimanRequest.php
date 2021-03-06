<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengirimanRequest extends FormRequest
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
        return [
            'tanggal_pengiriman' => 'required',
            'no_pengiriman' => 'required',
            'kurir' => 'required|string|max:100',
            'deskripsi' => 'required|max:200',
            'penjualan_id' => 'required',
        ];
    }
}
