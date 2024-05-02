<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocenteMateriaGrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'teacher_id'=>null,
                'subject_id'=>20,
                'group_id'=>5,
        ];
    }
}
