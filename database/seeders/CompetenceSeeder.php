<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('competences')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('competences')->insert([
            [
                'id' => 1,
                'name' => 'Centrado en el cliente',
                'description' => 'Es la capacidad de poner al cliente en el centro de las decisiones, escuchar sus necesidades y entregar valor desde el primer contacto a través de soluciones simples y cercanas, adaptando oportunamente la oferta de valor en pos del dinamismo y la necesidades del mercado.'
            ],
            [
                'id' => 2,
                'name' => 'Trabajar por objetivos comunes',
                'description' => 'Es la capacidad de trabajar en red, entendiendo la responsabilidad del rol individual en el impacto del cumplimiento de un objetivo común. Implica la participación activa en equipos multidisciplinarios y diversos, compartiendo conocimientos, habilidades y nuevos aprendizajes.'
            ],
            [
                'id' => 3,
                'name' => 'Calidad y cumplimiento',
                'description' => 'Es la capacidad de cumplir con los compromisos acordados y con los estándares de calidad esperados, respondiendo con éxito a las exigencias del mercado, siendo riguroso en el uso de metodologías de trabajo y manteniéndose actualizado en tendencias y mejores prácticas de su especialidad.'
            ],
            [
                'id' => 4,
                'name' => '',
                'description' => 'Capacidad de empoderar al equipo y actuar como facilitador del logro de objetivos, estableciendo una relación horizontal con equipo, dando espacios de desarrollo y valorando el aporte de los miembros del equipo y distinguiendo el error como parte del proceso de aprendizaje. '
            ],
            [
                'id' => 5,
                'name' => 'Innovación y Adaptación',
                'description' => 'Es la capacidad de crear valor a través de la experimentación y la búsqueda constantes de nuevas y mejores formas de hacer las cosas, además implica la adaptación a entornos cambiantes y nuevos escenarios y la capacidad de aprender de las experiencias.'
            ],
            [
                'id' => 6,
                'name' => 'Compromiso con el logro',
                'description' => 'Cumple objetivos y/o metas desafiantes, haciéndose responsable de punta a punta. Es capaz de reformularse permanentemente la manera de hacer las cosas buscando la mejora continua de forma ágil y en coordinación con otros para el cumplimiento de resultados.'
            ],
            [
                'id' => 7,
                'name' => 'Visión estratégica',
                'description' => 'Comprende el negocio y se adapta con éxito al dinamismo del entorno.'
            ],
            [
                'id' => 8,
                'name' => 'Impacto e influencia',
                'description' => 'Indaga y se muestra receptivo sobre los intereses del otro; influye en otros y se posiciona al interior de Entel, para cumplir sus propósitos e 
                impactar en los resultados.'
            ],
            [
                'id' => 9,
                'name' => 'Iniciativa',
                'description' => 'Busca y canaliza oportunidades de mejora, propone soluciones y es proactivo en su trabajo.'
            ],

        ]);
    }
}
