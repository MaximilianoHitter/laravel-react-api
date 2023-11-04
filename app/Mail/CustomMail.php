<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;


    public function asd()
    {
        //return $this->buildMailMessage();
        return $this->markdown('vendor.notifications.email')
                    ->subject('Custom Email Subject')
                    ->with([
                        'name' => 'John Doe',
                        'message' => 'This is a custom email message.',
                        'level' => '',
                        'introLines' => [
                            'asd',
                            'das'
                        ],
                        'outroLines' => []
                    ]);
    }

    public function mailCreateRutina($nombre_trainer, $nombre_rutina)
    {
        //return $this->buildMailMessage();
        return $this->markdown('vendor.notifications.email')
                    ->subject('Se ha creado una rutina nueva')
                    ->with([
                        'level' => '',
                        'introLines' => [
                            "El entrendor $nombre_trainer ha creado una nueva rutina para usted.",
                            "Podrá ver la rutina $nombre_rutina a partir de ahora en su calendario en nuestro portal."
                        ],
                        'outroLines' => []
                    ]);
    }
}
