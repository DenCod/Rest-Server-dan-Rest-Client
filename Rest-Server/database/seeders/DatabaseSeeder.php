<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Division;
use App\Models\Employees;
use App\Models\Position;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Division Table
        Division::create(
            [
                "division_name" => "Finance"
            ]
        );
        Division::create(
            [
                "division_name" => "Business"
            ]
        );


        // Position Table
        Position::create([
            "division_id" => 1,
            "position_name" => "Admin Finance"
        ]);
        Position::create([
            "division_id" => 2,
            "position_name" => "Junior Business"
        ]);


        // Employees Table
        Employees::create([
            "position_id" => 1,
            "name" => "Jhon Doe",
            "birth_date" => "2024-01-10",
            "phone_number" => "081254864578",
            "gender" => "Male",
            "join_date" => "2023-09-26",
            "is_active" => 1
        ]);
        Employees::create([
            "position_id" => 2,
            "name" => "Tifanny",
            "birth_date" => "1978-07-10",
            "phone_number" => "081549678947",
            "gender" => "Female",
            "join_date" => "2008-09-10",
            "is_active" => 1
        ]);
    }
}
