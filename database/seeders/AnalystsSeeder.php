<?php

namespace Database\Seeders;

use App\Models\Analyst;
use App\Models\User;
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
        $analyst = Analyst::create([
            "name" => "Analyst",
            "email" => "analyst@analyst.com",
            "password" => Hash::make("analyst@analyst.com")
        ]);

        User::create([
            "name" => "User",
            "email" => "client@client.com",
            "password" => Hash::make("1234"),
            "analyst_id" => $analyst->id
        ]);
    }
}
