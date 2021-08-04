<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Support\Facades\Auth;

class SendContato extends Mailable
{
    use Queueable, SerializesModels;

    //public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->dados = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('maxmeio.com@gmail.com')
                    ->subject('Formulário - Contato - Marilux - ' . ucwords(mb_strtolower($this->dados['name'])))
                    ->markdown('mail.SendContato')
                    ->with([
                        'name'      => ucwords(mb_strtolower($this->dados['name'])),
                        'email'     => mb_strtolower($this->dados['email']),
                        'message'     => $this->dados['message'],
                    ]);
    }
}
