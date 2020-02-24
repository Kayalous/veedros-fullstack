<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }
}
