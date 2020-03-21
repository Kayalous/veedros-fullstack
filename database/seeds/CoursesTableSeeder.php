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
        //Generates 10 random courses each with 5 chapters and 5 sessions each chapter

        for($i = 0; $i<10; $i++){
            $name = $faker->name;
            $slug = Str::slug($name, '-');
            \App\Course::create([
                'name' => $name,
                'instructor_id' => 1,
                'img' => "1584209495.png",
                'price' => rand(1,9999),
                'about' => $faker->address,
                'slug' => $slug
            ]);
                for($j = 1; $j<6; $j++){
                    $name = $faker->name;
                    $slug = Str::slug($name, '-');

                    \App\Chapter::create([
                        'course_id' => $i,
                        'name' => $name,
                        'slug' => $slug,
                        'about' => $faker->address
                    ]);
                        for($k = 1; $k<6; $k++){
                            $name = $faker->name;
                            $slug = Str::slug($name, '-');

                            \App\Session::create([
                                'chapter_id' => ($j + 5 * $i),
                                'name' => $name,
                                'slug' => $slug,
                                'about' => $faker->address,
                                'link' => 'https://www.youtube.com/watch?v=SEhSs5Uemsk'
                            ]);
                        }
                }
        }


    }
}
