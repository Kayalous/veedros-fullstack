<?php

use App\Instructor;
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
            Instructor::create([
                'user_id' => 1,
                'display_name' => Str::slug($faker->name, '-')
            ]);
        User::create([
            'name'           => 'Abdulrhman Elkayal',
            'email'          => 'aelkayal88@gmail.com',
            'password'       => bcrypt('123456789')
        ]);
        Instructor::create([
            'user_id' => 51,
            'display_name' => Str::slug('Abdulrhman Elkayal', '-')
        ]);
    }
}
