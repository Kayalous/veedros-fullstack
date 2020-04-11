<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['session_id', 'duration', 'duration_seconds', 'link_raw', 'link_360', 'link_480', 'link_720', 'link_1080'];

    public function session(){
        return $this->belongsTo(Session::class);
    }
}
