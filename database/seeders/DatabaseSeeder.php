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
       #insert a student into the database
       DB::table('STUDENTI')->insert([
           'NOME' => 'John Doe',
           'email' => 'asd@d.com',
           'password' => bcrypt('password'),
           'CODICE_FISCALE' => '1234567890',
           'COGNOME' => 'Doe',
           'DATA_DI_NASCITA' => '1999-01-01',
           'DATA_ISCRIZIONE' => '2021-01-01',
       ]);
        
    }
}
