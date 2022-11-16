<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('companies')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('companies')->insert([
            [
                'id' => 1,
                'business_name' => 'Evoluciona C.A.',
                'register_number' => '12345678'
            ],
            [
                'id' => 2,
                'business_name' => 'Hispano Soluciones C.A.',
                'register_number' => '987654321'
            ],
            [
                'id' => 3,
                'business_name' => 'Hispano C.A.',
                'register_number' => '00000000'
            ],
        ]);
    }
}
