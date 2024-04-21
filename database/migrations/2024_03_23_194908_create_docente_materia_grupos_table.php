<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocenteMateriaGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docente_materia_grupos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->nullable();
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docente_materia_grupos');
    }
}
