<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'name'=>'INTRODUCCIÓN A LA PROGRAMACIÓN',
                'departament_id' => 2
            ],
            [
                'name'=>'ÁLGEBRA I',
                'departament_id' => 1
            ],
            [
                'name'=>'ELEMENTOS',
                'departament_id' => 2
            ],
            [
                'name'=>'CÁLCULO I',
                'departament_id' => 1
            ],
            [
                'name'=>'SISTEMAS DE INFORMACIÓN I',
                'departament_id' =>  2
            ],
            [
                'name'=>'CÁLCULO II',
                'departament_id' => 1
            ],
            [
                'name'=>'INTELIGENCIA ARTIFICIAL I',
                'departament_id' => 2
            ],
            [
                'name'=>'INTELIGENCIA ARTIFICIAL II',
                'departament_id' => 2
            ],
            [
                'name'=>'SISTEMAS DE INFORMACIÓN II',
                'departament_id' =>  2
            ],
            [
                'name'=>'INGLES I',
                'departament_id' =>  2
            ],
            [
                'name'=>'INGLES II',
                'departament_id' =>  2
            ],
            [
                'name'=>'REDES AVANZADAS',
                'departament_id' =>  2
            ],
            [
                'name'=>'TALLER DE PROGRAMACION EN BAJO NIVEL',
                'departament_id' =>  2
            ],
            [
                'name'=>'GEOMETRIA',
                'departament_id' => 1
            ],
            [
                'name'=>'ÁLGEBRA II',
                'departament_id' => 1
            ],
            [
                'name'=>'ECUACIONES DIFERENCIALES',
                'departament_id' => 6
            ],
            [
                'name'=>'ANALISIS VECTORIAL Y TENSORIAL',
                'departament_id' => 5
            ],
            [
                'name'=>'ARQUITECTURA DE COMPUTADORAS I',
                'departament_id' =>  2
            ],
            [
                'name'=>'CIRCUITOS ELECTRONICOS',
                'departament_id' => 9
            ],
            [
                'name'=>'ELECTROTECNIA INDUSTRIAL',
                'departament_id' => 3
            ],
            [
                'name'=>'ARQUITECTURA DE COMPUTADORAS II',
                'departament_id' => 8
            ],
            [
                'name'=>'FISICA BASICA II',
                'departament_id' =>  6
            ],
            [
                'name'=>'DISEÑO DE SISTEMAS DIGITALES I',
                'departament_id' =>  10
            ],
            [
                'name'=>'PRACTICA EMPRESARIAL',
                'departament_id' =>  2
            ],
            [
                'name'=>'SEGURIDAD DE SISTEMAS',
                'departament_id' =>  2
            ],
            [
                'name'=>'CONTABILIDAD BASICA',
                'departament_id' => 3
            ],
            [
                'name'=>'ECONOMIA POLITICA',
                'departament_id' => 5
            ],
            [
                'name'=>'INGENIERIA ECONOMICA',
                'departament_id' => 3
            ],
            [
                'name'=>'APLICACION DE SISTEMAS OPERATIVOS',
                'departament_id' => 2
            ],
            [
                'name'=>'TALLER DE SIMULACION DE SISTEMAS',
                'departament_id' =>  2
            ],
            [
                'name'=>'TALLER DE SISTEMAS OPERATIVOS',
                'departament_id' => 2
            ],
            [
                'name'=>'ARQUITECTURA DE SOFTWARE',
                'departament_id' => 8
            ],
            [
                'name'=>'ALGORITMOS AVANZADOS',
                'departament_id' => 8
            ],
            [
                'name'=>'TALLER DE INGENIERIA DE SOFTWARE',
                'departament_id' =>  8
            ],
            [
                'name'=>'CIRCUITOS ELECTRONICOS II',
                'departament_id' =>  9
            ],
            [
                'name'=>'SISTEMAS HIDRAULICOS Y NEUMATICOS',
                'departament_id' =>  11
            ],
            [
                'name'=>'BASE DE DATOS I',
                'departament_id' =>  2
            ],
            [
                'name'=>'TALLER DE BASE DE DATOS',
                'departament_id' =>  2
            ],
            [
                'name'=>'BASE DE DATOS II',
                'departament_id' => 2
            ],
            [
                'name'=>'INGENIERIA DE SOFTWARE',
                'departament_id' => 8
            ],
            [
                'name'=>'ORGANIZACION Y METODOS',
                'departament_id' => 8
            ],
            [
                'name'=>'CALCULO NUMERICO',
                'departament_id' => 6
            ],
            [
                'name'=>'FRACTALES',
                'departament_id' =>  1
            ],
            [
                'name'=>'MATEMATICA DISCRETA',
                'departament_id' => 1
            ],
            [
                'name'=>'TRANSFORMADAS INTEGRALES',
                'departament_id' => 6
            ],
            [
                'name'=>'PROGRAMACION WEB',
                'departament_id' => 8
            ],
            [
                'name'=>'ENTORNOS VIRTUALES DE APRENDIZAJE',
                'departament_id' =>  8
            ],
            [
                'name'=>'PROBABILIDAD Y ESTADISTICA',
                'departament_id' =>  5
            ],
            [
                'name'=>'METODOL. Y PLANIF. DE PROYECTO DE GRADO',
                'departament_id' =>  2
            ],
            [
                'name'=>'SISTEMAS I',
                'departament_id' =>  2
            ],
            [
                'name'=>'SISTEMAS II',
                'departament_id' =>  2
            ],
            [
                'name'=>'FISICA BASICA III',
                'departament_id' => 6
            ],
            [
                'name'=>'FISICA GENERAL',
                'departament_id' => 2
            ],
            [
                'name'=>'FISICA MODERNA',
                'departament_id' => 10
            ],
            [
                'name'=>'INTERACCION HUMANO COMPUTADOR',
                'departament_id' => 8
            ],
            [
                'name'=>'METODOS Y TECNICAS DE PROGRAMACION',
                'departament_id' =>  8
            ],
            [
                'name'=>'METODOS, TECNICAS Y TALLER DE PROGRAMACION',
                'departament_id' => 8
            ],
            [
                'name'=>'TALLER DE GRADO I',
                'departament_id' => 8
            ],
            [
                'name'=>'ESTADISTICA',
                'departament_id' => 11
            ],
            [
                'name'=>'GESTION DE CALIDAD',
                'departament_id' =>  10
            ],
            [
                'name'=>'PREP. Y EVAL. DE PROYECTOS II',
                'departament_id' =>  3
            ],
            [
                'name'=>'MERCADOTECNIA',
                'departament_id' =>  3
            ],
            [
                'name'=>'QUIMICA GENERAL',
                'departament_id' =>  4
            ],
            [
                'name'=>'BIOLOGIA GENERAL',
                'departament_id' =>  7
            ],
            [
                'name'=>'BIOLOGIA CELULAR Y MOLECULAR',
                'departament_id' =>  7
            ],
            [
                'name'=>'HISTOLOGIA ANIMAL COMPARADA',
                'departament_id' =>  7
            ],
            [
                'name'=>'ZOOLOGIA DE INVERTEBRADOS',
                'departament_id' =>  7
            ],
            [
                'name'=>'RECURSOS NATURALES',
                'departament_id' =>  4
            ],
            [
                'name'=>'QUIMICA ANALITICA',
                'departament_id' =>  4
            ],
            [
                'name'=>'EQUILIBRIOS EN DISOLUCION',
                'departament_id' =>  4
            ],
            [
                'name'=>'QUIMICA ORGANICA',
                'departament_id' =>  4
            ],
        ]);
    }
}
