<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       #insert an admin table ADMIN 

        
        DB::table('ADMIN')->insert([
            'username' => 'pavel',
            'password' => bcrypt('levap'),
            'code' => 12341
        ]);
    
    }
}
