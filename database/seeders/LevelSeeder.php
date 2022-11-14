<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('levels')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('levels')->insert([
            [
                'id' => 1,
                'name' => 'Sobre lo esperado (destacado/excepcional)',
            ],
            [
                'id' => 2,
                'name' => 'Esperado',
            ],
            [
                'id' => 3,
                'name' => 'Bajo lo esperado (insuficiente/necesita mejora)',
            ],
        ]);
    }
}
