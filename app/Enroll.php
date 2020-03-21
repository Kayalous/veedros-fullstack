<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TusPhp\Request;

class Enroll extends Model
{
    protected $fillable = ['user_id', 'course_id'];
}
