<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function member(){
        return $this->belongsTo(Member::class);
    }

    public function university(){
        return $this->hasOne(University::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function subscription(){
        return $this->hasOne(Subscription::class);
    }
}
