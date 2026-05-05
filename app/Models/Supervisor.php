<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    public function member(){
        return $this->belongsTo(Member::class);
    }

    public function university(){
        return $this->belongsTo(University::class);
    }
}
