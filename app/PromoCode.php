<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = ['code', 'unlimited', 'global', 'discount_percentage', 'number_of_uses'];

    public function courses(){
        return $this->belongsToMany('App\Course', 'course_promo_code', 'promo_code_id', 'course_id');
    }
    public function hasCourse(Course $course) {
        return $this->courses->contains($course);
    }
}
