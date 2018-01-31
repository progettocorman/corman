<?php

use Illuminate\Database\Seeder;

class N_TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('n_types')->insert([
        'id' => 0,
        'description' => "CoAuthor Notifications",
      ]);

      DB::table('n_types')->insert([
        'id' => 0,
        'description' => "Group Partecipation Notifications",
      ]);
    }
}
