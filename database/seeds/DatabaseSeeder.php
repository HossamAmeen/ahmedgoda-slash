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
        // $this->call(UserSeeder::class);
        $this->call([
            UserSeed::class,
        ]);
      factory('App\Models\Configration',1)->create();
      factory('App\Models\Article',30)->create();
    }
}
