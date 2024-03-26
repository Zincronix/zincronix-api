<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocMatGruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doc_mat_grus')->insert([
            [
                'teacher_id'=>1,
                'subject_id'=>1,
                'group_id'=>1,
            ],
            [
                'teacher_id'=>1,
                'subject_id'=>1,
                'group_id'=>1,
            ],
            [
                'teacher_id'=>1,
                'subject_id'=>2,
                'group_id'=>2,
            ],
            [
                'teacher_id'=>2,
                'subject_id'=>2,
                'group_id'=>3,
            ],
            [
                'teacher_id'=>3,
                'subject_id'=>3,
                'group_id'=>3,
            ],
            [
                'teacher_id'=>3,
                'subject_id'=>3,
                'group_id'=>3,
            ],
        ]);
    }
}
