<?php

namespace Database\Seeders;

use App\Models\Availability;
use App\Models\AvailabilityPeriod;
use App\Models\Characteristic;
use App\Models\DocenteMateriaGrupo;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DepartamentSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(StatusReservationSeeder::class);
        $this->call(RangeSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(CharacteristicSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(DocenteMateriaGrupoSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(AvailabilitySeeder::class);
        $this->call(AvailabilityPeriodSeeder::class);
        $this->call(HolidaySeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(BuildingSeeder::class);
    }
}
