<?php

namespace Database\Seeders;

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
        $this->call(StatusRequestSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(CondSpecialSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(DocMatGruSeeder::class);
    }
}
