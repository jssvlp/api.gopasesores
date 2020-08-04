<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OccupationSeeder::class);
        $this->call(EconomicActSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(ClientSeeder::class);

        $this->call(BranchSeeder::class);
        $this->call(InsuranceSeeder::class);

    }
}
