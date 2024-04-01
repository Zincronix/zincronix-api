<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\DocenteMateriaGrupo;
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
    }
}
