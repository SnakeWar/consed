<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Hosting;

class SendMailHosting extends Mailable
{
    use Queueable, SerializesModels;

    public $hosting;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Hosting $hosting)
    {
        $this->hosting = $hosting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contato@maxgestao.com.br')
                    ->markdown('mail.notification-markdown')
                    ->with([
                        'url'   =>  route('admin.home'),
                    ]);
    }
}
