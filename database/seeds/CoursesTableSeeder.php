<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;


class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 0; $i<50; $i++){
            $name = $faker->name;
            $random = Str::random(5);
            $slug = Str::slug($name . ' ' . $random, '-');
            \App\Course::create([
                'name' => $name,
                'instructor_id' => 1,
                'img' => "1584209495.png",
                'price' => rand(1,9999),
                'about' => $faker->address,
                'slug' => $slug
            ]);
        }


    }
}
