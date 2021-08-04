<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicUtilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create_public_utilities');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->redirect = url()->previous() . '#contato';
        return [
            'title'       => 'required|max:255',
            'file'      => 'required|file',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'        => 'O campo título não pode ser vazio.',
            'file.required'        => 'Imagem obrigatória.',
            'phone.required'       => 'Digite um telefone para contato.',
            'email3.required'       => 'Digite um e-mail para contato.',
            'message.required'       => 'Digite uma mensagem.',
            'curriculum.required'  => 'Por favor, anexe um arquivo (.pdf) para envio.',
        ];
    }
}
