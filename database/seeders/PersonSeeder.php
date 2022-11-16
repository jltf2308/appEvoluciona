<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('people')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('people')->insert([
            [
                'id' => 1,
                'first_name' => 'Manuel',
                'last_name' => 'Vergara',
                'register_number' => '12345678',
                'email' => 'test@test.com',
                'position' => 'SEO',
                'type' => 'Admin',
                'company_id' => 1
            ],
            [
                'id' => 2,
                'first_name' => 'José',
                'last_name' => 'Tovar',
                'register_number' => '19928251',
                'email' => 'test@test.com',
                'position' => 'Desarrollador',
                'type' => 'Professional',
                'company_id' => 1
            ],
            [
                'id' => 3,
                'first_name' => 'Ramon',
                'last_name' => 'Tovar',
                'register_number' => '12356789',
                'email' => 'test@test.com',
                'position' => 'Desarrollador',
                'type' => 'Professional',
                'company_id' => 1
            ],
            [
                'id' => 4,
                'first_name' => 'Adelis',
                'last_name' => 'Araul',
                'register_number' => '12356789',
                'email' => 'admin@hispanos.com',
                'position' => 'Administrador',
                'type' => 'Client',
                'company_id' => 2
            ],
            [
                'id' => 5,
                'first_name' => 'Luis',
                'last_name' => 'Tovar',
                'register_number' => '11111111',
                'email' => 'test@test.com',
                'position' => 'Desarrollador',
                'type' => 'Professional',
                'company_id' => 1
            ],
            [
                'id' => 6,
                'first_name' => 'Fernando',
                'last_name' => 'Tovar',
                'register_number' => '22222222',
                'email' => 'test@test.com',
                'position' => 'Desarrollador',
                'type' => 'Professional',
                'company_id' => 1
            ],
            [
                'id' => 7,
                'first_name' => 'Carlos',
                'last_name' => 'Tovar',
                'register_number' => '33333333',
                'email' => 'test@test.com',
                'position' => 'Desarrollador',
                'type' => 'Professional',
                'company_id' => 1
            ],
        ]);
    }
}
