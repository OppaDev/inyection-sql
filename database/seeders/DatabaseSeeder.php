<?php

namespace Database\Seeders;

use App\Models\Cuenta;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    



        for ($i=0; $i <10 ; $i++) { 
            $cuenta=new Cuenta();
            $cuenta->usuario='Usuario '. $i;
            $cuenta->saldo=$i*25;
            $cuenta->save();
        }

        

    }
}
