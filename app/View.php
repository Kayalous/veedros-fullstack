<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ['session_id', 'user_id', 'course_id', 'enrolled', 'ip_address'];
}
