<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experince extends Model
{
    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }
}
