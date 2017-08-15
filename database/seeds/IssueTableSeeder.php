<?php

use Illuminate\Database\Seeder;

class IssueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(IssueTableSeeder::class);

        Model::reguard();
    }
}
