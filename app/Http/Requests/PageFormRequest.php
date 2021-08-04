<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create_pages');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:200',
            'content'   => 'required',
            //'file'     => 'required|image|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Título obrigatório',
            'content.required' => 'Conteúdo obrigatória',
            'published_at.required' => 'Data de publicação obrigatória',
            'file.required' => 'Imagem obrigatória',
            'file.image' => 'Precisa ser uma imagem',
            'file.max' => 'Tamanho máximo de 2mbs',
        ];
    }
}
