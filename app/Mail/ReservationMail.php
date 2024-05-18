<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $classrooms, $date, $docenteMateriaGrupo, $hour;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($classrooms, $date, $docenteMateriaGrupo, $hour)
    {
        $this->classrooms = $classrooms;

        // dd($classrooms);
        $this->date = $date;
        $this->docenteMateriaGrupo = $docenteMateriaGrupo;
        $this->hour = $hour;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservations.confirmar');
    }
}
