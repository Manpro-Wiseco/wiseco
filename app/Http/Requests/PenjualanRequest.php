<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanRequest extends FormRequest
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
            'pelanggan_id' => 'required',
            'penjualan_id' => 'required',
            'no_pesanan' => 'required',
            'tanggal' => 'required',
            'no_penjualan' =>'required',
            'deskripsi' => 'required|max:400',
            'other_cost' => 'required|integer',
            'discount' => 'required|integer',
            'potongan' => 'integer',
            'nilai' => 'integer',
            'pajak' => 'required|integer',
            'items.*.id' => 'required',
            'items.*.qty' => 'required|integer',
            'items.*.harga_unit' => 'required|integer',
            'items.*.total' => 'required|integer',
            'total_pembayaran' =>'required|integer',
            'sisa_pembayaran' =>'required|integer',
            'status_pembayaran' =>'required',
            'data_bank_id' =>'required'
        ];
    }
}
