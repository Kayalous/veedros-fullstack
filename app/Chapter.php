<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Chapter extends Model
{
    use Searchable;

    protected $fillable = ['name', 'course_id', 'slug', 'about'];
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function sessions(){
        return $this->hasMany(Session::class);
    }
    public function searchableAs()
    {
        return 'Chapters';
    }
}
