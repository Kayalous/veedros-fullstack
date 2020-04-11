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
        //Generates 12 random courses each with 5 chapters and 5 sessions each chapter

        //Each session has 2 objectives
        $sessionCounter = 1;
        for($i = 1; $i<=12; $i++){
            $name = $faker->name;
            $slug = Str::slug($name, '-');

            $course = \App\Course::create([
                'name' => $name,
                'instructor_id' => 1,
                'img' => "https://veedros.s3.eu-central-1.amazonaws.com/courses/2/hellloo/images/tdzHq4nTU7zkOOmjoTEXVq8ZFlpqoTBAxIljBlhl.jpeg",
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
                            $minutes = rand(0,10);
                            $seconds = rand(10,59);
                            $duration = $minutes . ':' . $seconds;
                            if($i === 1)
                                $chapterId = $j;
                            else
                                $chapterId = $j + 5 * ($i - 1);


                            $session = \App\Session::create([
                                'chapter_id' => $chapterId,
                                'name' => $name,
                                'slug' => $slug,
                                'about' => $faker->paragraph(5)]);

                            $video = \App\Video::create([
                                'session_id' => $session->id,
                                'link_360' => 'https://veedros.s3.eu-central-1.amazonaws.com/Test-videos/360p.mp4',
                                'link_480' => 'https://veedros.s3.eu-central-1.amazonaws.com/Test-videos/480p.mp4',
                                'link_720' => 'https://veedros.s3.eu-central-1.amazonaws.com/Test-videos/720p.mp4',
                                'duration' => '3:30',
                                'duration_seconds' => '210'
                            ]);
                            for($h = 0; $h < 3; $h++)
                                \App\Objective::create([
                                    'session_id' => $sessionCounter,
                                    'title' =>$faker->name,
                                    'objective' => $faker->paragraph()
                                ]);
                            $sessionCounter++;

                        }
                }
            \App\Course::calculateAndSaveTotalRuntime($course);
        }
        for($i = 1; $i <= 10; $i++){

                for($j = 0; $j < 10; $j ++)
                    \App\Objective::create(['course_id' => $i,
                        'objective' => $faker->city]);
                for($j = 0; $j < 3; $j ++)
                     \App\Recommendation::create(['course_id' => $i,
                        'recommendation' => $faker->colorName]);
        }




    }
}
