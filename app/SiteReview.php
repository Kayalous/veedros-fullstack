<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteReview extends Model
{
    protected $fillable = ['body', 'rating', 'user_id', 'approved'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
