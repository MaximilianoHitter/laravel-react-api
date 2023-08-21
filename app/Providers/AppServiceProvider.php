<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /* ResetPassword::$toMailCallback = function($notifiable, $verificationURL){
            return (new MailMessage)
            ->subject(Lang::get('Notificación de Reinicio de Contraseña'))
            ->line(Lang::get('Está recibiendo este email porque se ha requerido un cambio de contraseña para su cuenta.'))
            ->action(Lang::get('Reiniciar Contraseña'), $verificationURL)
            ->line(Lang::get('Este link para reinicio de contraseña expirará en :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Si usted no ha requerido un cambio de contraseña desestime este email.'));
        }; */
    }
}
