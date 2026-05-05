<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'university_id',
        'member_id',
    ];
    public function member(){
        return $this->belongsTo(Member::class);
    }

    public function university(){
        return $this->belongsTo(University::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }

    public function currentApplication() {
        return $this->hasOne(Application::class)->where('status', 'accepted')->latestOfMany();
    }
}
