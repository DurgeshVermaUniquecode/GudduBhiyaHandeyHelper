<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin',     'order_by' => 1,    'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Employee',  'order_by' => 2,    'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vendor',    'order_by' => 3,    'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User',      'order_by' => 4,    'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
