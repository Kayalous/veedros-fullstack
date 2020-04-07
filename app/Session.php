<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['name', 'chapter_id', 'link', 'slug', 'about', 'duration'];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function objectives(){
        return $this->hasMany(Objective::class);
    }

    public function isFirstSession(){
        $chapter = $this->chapter()->first();
        $course = $chapter->course()->first();
        $firstChapter = $course->chapters()->first();
        $firstSession = $firstChapter->sessions()->first();
        if($firstSession->id === $this->id)
            return false;
        else
            return true;
    }
}
