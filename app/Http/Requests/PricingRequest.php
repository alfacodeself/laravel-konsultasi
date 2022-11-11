<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PricingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_paket' => 'required',
            'sesi' => 'required|numeric|min:1',
            'harga_paket' => 'required|numeric|min:0',
            'fitur.*' => 'required'
        ];
    }
}
