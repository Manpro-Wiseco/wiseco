<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PiutangRequest extends FormRequest
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
            'penjualan_id'      => 'required',
            'sisa_piutang'      => 'required|integer',
            'no_piutang'        => 'required|string',
            'tanggal_awal_kredit' => 'required',
            'tenor'             => 'required|integer',
            'status'            => 'required',
            'beban_pembayaran'  => 'required'
        ];
    }
}
