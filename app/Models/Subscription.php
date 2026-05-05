<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
