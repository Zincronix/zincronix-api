<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $classrooms, $date, $docenteMateriaGrupo, $hour;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($classrooms, $date, $hour)
    {
        $this->classrooms = $classrooms;
        $this->date = $date;
        $this->hour = $hour;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservations.rechazar', [
            'classrooms' => $this->classrooms,
            'date' => $this->date,
            'docenteMateriaGrupo' => $this->docenteMateriaGrupo,
            'hour' => $this->hour
        ])->subject('Rechazo de solicitud de Reserva');
    }
}
