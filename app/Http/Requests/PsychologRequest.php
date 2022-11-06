<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PsychologRequest extends FormRequest
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

    public function rules()
    {
        if (request()->routeIs('admin.psycholog.store')) {
            $rule = 'required';
        }elseif (request()->routeIs('admin.psycholog.update')) {
            $rule = 'nullable';
        }
        return [
            'gambar' => $rule . '|image|mimes:png,jpg,jpeg,gif|max:5000',
            'judul' => 'required',
            'deskripsi' => 'required|min:3',
            'harga' => 'required|numeric|min:0'
        ];
    }
}
