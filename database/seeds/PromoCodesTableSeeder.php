<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
class PromoCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 1; $i<=10; $i++){
            $code = 'CODE-TEST-' . $i * 10;
            $promoCode = \App\PromoCode::create([
                'code' =>$code,
                'discount_percentage' => $i * 10,
                'number_of_uses' => (11 - $i)]);
            $promoCode->courses()->attach(1);
        }
        $promoCode = \App\PromoCode::create([
            'code' => 'MULTIPLE-COURSES-100',
            'discount_percentage' => 100,
            'number_of_uses' => (3),
            'unlimited' => true]);
        $promoCode->courses()->attach(1);
        $promoCode->courses()->attach(2);
        $promoCode->courses()->attach(3);
        $promoCode->courses()->attach(4);
        $promoCode->courses()->attach(5);
    }
}
