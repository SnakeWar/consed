<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
        $this->redirect = url()->previous() . '#contato';
        return [
            'name'       => 'required|max:255',
            'email3'      => 'required|max:255',
            'message'   => 'required'
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
            'name.required'        => 'O campo nome não pode ser vazio.',
            'area.required'        => 'Informe sua área de atuação.',
            'phone.required'       => 'Digite um telefone para contato.',
            'email3.required'       => 'Digite um e-mail para contato.',
            'message.required'       => 'Digite uma mensagem.',
            'curriculum.required'  => 'Por favor, anexe um arquivo (.pdf) para envio.',
        ];
    }
}
