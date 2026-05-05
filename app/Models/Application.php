<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    protected $fillable = ['student_id', 'training_id', 'status'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function training(){
        return $this->belongsTo(Training::class);
    }

    public function report(){
        return $this->hasOne(Report::class);
    }
}
