<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('questions')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('questions')->insert([
            [
                'id' => 1,
                'description' => 'Promueve prácticas de escucha activa de las visiones y problemáticas del cliente, para instalar procesos donde se puedan anticipar sus necesidades.',
                'competence_id' => 1,
                'level_id' => 1
            ],
            [
                'id' => 2,
                'description' => 'Usa su experiencia para orientar a otros respecto a cómo focalizar el trabajo, dando prioridad a aquello que agrega valor al cliente y fortalece la relación.',
                'competence_id' => 1,
                'level_id' => 1
            ],
            [
                'id' => 3,
                'description' => 'Se destaca por entregar soluciones simples y cercanas que agregan valor.',
                'competence_id' => 1,
                'level_id' => 1
            ],
            [
                'id' => 4,
                'description' => 'Promueve que los equipos estén continuamente mejorando la experiencia de servicio.',
                'competence_id' => 1,
                'level_id' => 1
            ],
            [
                'id' => 5,
                'description' => 'Instala y transfiere procesos que facilitan acortar tiempos de respuesta al cliente, resguardando siempre la calidad.',
                'competence_id' => 1,
                'level_id' => 1
            ],
            [
                'id' => 6,
                'description' => 'Comparte prácticas de fidelización de clientes basadas en generar relaciones de confianza.',
                'competence_id' => 1,
                'level_id' => 1
            ],
            [
                'id' => 7,
                'description' => 'Escucha activamente las visiones y problemáticas del cliente con el fin de cumplir sus expectativas y anticiparse a sus necesidades.',
                'competence_id' => 1,
                'level_id' => 2
            ],
            [
                'id' => 8,
                'description' => 'Entrega soluciones simples y cercanas, orientadas a generar valor desde el primer contacto.',
                'competence_id' => 1,
                'level_id' => 2
            ],
            [
                'id' => 9,
                'description' => 'Mejora continuamente la experiencia de servicio.',
                'competence_id' => 1,
                'level_id' => 2
            ],
            [
                'id' => 10,
                'description' => 'Focaliza y prioriza su trabajo en aquello que agrega valor al cliente y fortalece la relación.',
                'competence_id' => 1,
                'level_id' => 2
            ],
            [
                'id' => 11,
                'description' => 'Busca acortar los tiempos de respuesta a través de la iteración y retroalimentación continua.',
                'competence_id' => 1,
                'level_id' => 2
            ],
            [
                'id' => 12,
                'description' => 'Establece relaciones de confianza y satisfactorias con los clientes.',
                'competence_id' => 1,
                'level_id' => 2
            ],
            [
                'id' => 13,
                'description' => 'Muestra dificultad para escuchar de manera activa las visiones y problemáticas del cliente.',
                'competence_id' => 1,
                'level_id' => 3
            ],
            [
                'id' => 14,
                'description' => 'Requiere apoyo para entender el negocio o la problemática del cliente y para entregar soluciones simples que agreguen valor.',
                'competence_id' => 1,
                'level_id' => 3
            ],
            [
                'id' => 15,
                'description' => 'Requiere apoyo para focalizar su trabajo en aquello que agrega valor y fortalece la relación con el cliente.',
                'competence_id' => 1,
                'level_id' => 3
            ],
            [
                'id' => 16,
                'description' => 'Si bien cumple en tiempo y forma sus compromisos con los clientes, no es activo en buscar acortar sus tiempos de respuesta.',
                'competence_id' => 1,
                'level_id' => 3
            ],
            [
                'id' => 17,
                'description' => 'Podría requerir apoyo para iniciar relaciones de confianza con los clientes. ',
                'competence_id' => 1,
                'level_id' => 3
            ],
            [
                'id' => 18,
                'description' => 'Si bien establece vínculos cercanos con clientes conocidos, le cuesta mantener relaciones satisfactorias.',
                'competence_id' => 1,
                'level_id' => 3
            ],
            
            
        ]);
    }
}
