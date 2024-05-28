<?php

namespace App\Jobs;

use App\Mail\ReservationMail;
use App\Mail\ReservationRejectedMail;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $reservation, $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, $type)
    {
        $this->reservation = $reservation;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $id = $this->reservation->id;
        $teachers = $this->reservation->docenteMateriaGrupos->pluck('teacher');
        $classrooms = $this->reservation->classrooms->map(function ($classroom) {
            return [
                'name' => $classroom->name,
                'capacity' => $classroom->capacity,
            ];
        })->toArray();
        $convertirDate = $this->convertirDate($this->reservation->date);
        $convertirHour = $this->convertirHour($this->reservation->periods);

        $emails = $teachers->pluck('email')->unique()->values()->toArray();
        $primaryEmail = array_shift($emails);

        switch ($this->type){
            case 1:
                $mail = new ReservationMail($id, $classrooms, $convertirDate, $convertirHour);
                break;
            case 3:
                $mail = new ReservationRejectedMail($classrooms, $convertirDate, $convertirHour);
                break;
            default:
                $mail = null;
                break;
        }

        if($mail !== null){
            Mail::to($primaryEmail)
            ->cc($emails)
            ->send($mail);
        }

    }

    private function convertirDate($date)
    {
        $fechaCarbon = Carbon::createFromFormat('Y-m-d', $date);
        Carbon::setLocale('es');

        return $fechaCarbon->isoFormat('dddd, D [de] MMMM [de] YYYY');
    }

    private function convertirHour($periods)
    {
        $arrPeriods = $periods->pluck('hour');
        $primeraHora = $arrPeriods->first();
        $ultimaHora = $arrPeriods->last();

        return $primeraHora . ' a ' . $ultimaHora;
    }
}
