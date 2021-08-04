<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerFormRequest extends FormRequest
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        return [
            'title' => 'required|max:200',
            'published_at' => 'required',
            'file' => 'required|image|max:2048',
            'file_mobile' => 'image|max:2048',
            'url' => 'regex:' . $regex
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Título obrigatório',
            'url.regex' => 'URL invalida',
            'published_at.required' => 'Data de publicação obrigatória',
            'file.required' => 'Imagem obrigatória',
            'file.image' => 'Precisa ser uma imagem',
            'file.max' => 'Tamanho máximo de 2mbs',
            'file_mobile.image' => 'Precisa ser uma imagem',
            'file_mobile.max' => 'Tamanho máximo de 2mbs',
        ];
    }
}
