<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['name', 'chapter_id', 'link', 'slug', 'about'];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }
}
