<?php

namespace Database\Seeders;

use App\Models\Analyst;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AnalystsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Analyst::create([
            "name" => "Analyst",
            "email" => "analyst@analyst.com",
            "password" => Hash::make("analyst@analyst.com")
        ]);
    }
}
