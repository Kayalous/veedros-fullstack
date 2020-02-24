<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
    $faker = Faker::create();

        for($i = 0; $i<50; $i++)
            User::create([
                'name'           => $faker->name,
                'email'          => $faker->email,
                'password'       => bcrypt('password')
            ]);

    }
}
