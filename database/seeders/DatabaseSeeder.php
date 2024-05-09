<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory(5)->create()->each(function ($company) {
            $company->employees()->saveMany(Employee::factory(5)->create(['company_id' => $company->id]));
        });
    }

}
