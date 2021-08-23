<?php

use App\Chapter;
use App\Course;
use App\Objective;
use App\Recommendation;
use App\Session;
use App\Video;
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

            $course = Course::create([
                'name' => $name,
                'instructor_id' => 1,
                'img' => "/images/course-example.jpg",
                'price' => rand(1,200),
                'about' => $faker->address,
                'slug' => $slug
            ]);

                for($j = 1; $j<6; $j++){
                    $name = $faker->name;
                    $slug = Str::slug($name, '-');

                    Chapter::create([
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


                            $session = Session::create([
                                'chapter_id' => $chapterId,
                                'name' => $name,
                                'slug' => $slug,
                                'about' => $faker->paragraph(5)]);

                            $video = Video::create([
                                'session_id' => $session->id,
                                'link_360' => 'https://veedros.s3.eu-central-1.amazonaws.com/Test-videos/360p.mp4',
                                'link_480' => 'https://veedros.s3.eu-central-1.amazonaws.com/Test-videos/480p.mp4',
                                'link_720' => 'https://veedros.s3.eu-central-1.amazonaws.com/Test-videos/720p.mp4',
                                'duration' => '3:30',
                                'duration_seconds' => '210'
                            ]);
                            for($h = 0; $h < 3; $h++)
                                Objective::create([
                                    'session_id' => $sessionCounter,
                                    'title' =>$faker->name,
                                    'objective' => $faker->paragraph()
                                ]);
                            $sessionCounter++;

                        }
                }
            Course::calculateAndSaveTotalRuntime($course);
        }
        for($i = 1; $i <= 10; $i++){

                for($j = 0; $j < 10; $j ++)
                    Objective::create(['course_id' => $i,
                        'objective' => $faker->city]);
                for($j = 0; $j < 3; $j ++)
                     Recommendation::create(['course_id' => $i,
                        'recommendation' => $faker->colorName]);
        }




    }
}
