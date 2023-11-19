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

    public function mailCreatePlan($nombre_specialist, $nombre_plan)
    {
        //return $this->buildMailMessage();
        return $this->markdown('vendor.notifications.email')
                    ->subject('Se ha creado un nuevo plan')
                    ->with([
                        'level' => '',
                        'introLines' => [
                            "El Especialista $nombre_specialist ha creado un nuevo plan para usted.",
                            "Podrá ver el plan $nombre_plan a partir de ahora en su calendario en nuestro portal."
                        ],
                        'outroLines' => []
                    ]);
    }

    public function mailPaymentCreate($nombre_student, $nombre_rutina)
    {
        //return $this->buildMailMessage();
        return $this->markdown('vendor.notifications.email')
                    ->subject('Se ha creado un nuevo Pago')
                    ->with([
                        'level' => '',
                        'introLines' => [
                            "El Alumno $nombre_student ha creado un Pago.",
                            "Podrá ver el pago para $nombre_rutina a partir de ahora en su listado de pagos, en nuestro portal."
                        ],
                        'outroLines' => []
                    ]);
    }

    public function mailPaymentCreateStudent($nombre_rutina)
    {
        //return $this->buildMailMessage();
        return $this->markdown('vendor.notifications.email')
                    ->subject('Se ha creado un nuevo Pago')
                    ->with([
                        'level' => '',
                        'introLines' => [
                            "Se ha registrado un pago para $nombre_rutina."
                        ],
                        'outroLines' => []
                    ]);
    }
}
