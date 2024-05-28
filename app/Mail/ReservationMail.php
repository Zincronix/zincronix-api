<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $id, $classrooms, $date, $docenteMateriaGrupo, $hour;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $classrooms, $date, $hour)
    {
        $this->id = $id;
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
        return $this->markdown('emails.reservations.confirmar', [
            'id' => $this->id,
            'classrooms' => $this->classrooms,
            'date' => $this->date,
            'docenteMateriaGrupo' => $this->docenteMateriaGrupo,
            'hour' => $this->hour
        ])->subject('Confirmación de Reserva');
    }
}
