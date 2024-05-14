<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation, $classrooms, $teachers, $subjects;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation, $classrooms, $teachers, $subjects)
    {
        $this->reservation = $reservation;
        $this->classrooms = $classrooms;
        $this->teachers = $teachers;
        $this->subjects = $subjects;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservations.confirmar')
                    ->with([
                        'date' => "Lunes 24 de mayo",
                        'hora' => "De 08:15 am. a 09:45 am."
                    ]);
    }
}
