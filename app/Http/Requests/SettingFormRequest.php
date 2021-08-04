<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create_banners');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => 'required',
            'value' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'key.required' => 'Chave obrigatória',
            'value.required' => 'Valores obrigatórios',
        ];
    }
}
