<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class TeacherControllerTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function test_store_teacher_with_subjects_and_groups()
    {
        $subjects = Subject::factory()->count(2)->create();

        // Datos de prueba
        $data = [
            'name' => 'Marco Idalgo',
            'email' => 'marco2@gmail.com',
            'subjects' => [
                ['subject_id' => $subjects[0]->id, 'groups' => [2]],
                ['subject_id' => $subjects[1]->id, 'groups' => [1, 2]],
            ],
        ];

        $response = $this->postJson('/api/teachers', $data);

        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson(['message' => 'Teacher created successfully']);

        $responseBody = $response->json();

        // Verificar que se haya creado el profesor
        $this->assertDatabaseHas('teachers', [
            'name' => $data['name'],
            'email' => $data['email'],
            'active' => true,
        ]);

        $teacher = Teacher::where('email', $data['email'])->first();

        // Verificar que se hayan asociado correctamente las materias y grupos
        foreach ($subjectInfo as $subject) {
            foreach ($subject['groups'] as $groupId) {
                $this->assertDatabaseHas('docente_materia_grupos', [
                    'teacher_id' => $teacher->id,
                    'subject_id' => $subject['subject_id'],
                    'group_id' => $groupId,
                ]);
            }
        }
    }
}
