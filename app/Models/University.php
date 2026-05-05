<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'organization_id',
    ];
    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function supervisors(){
        return $this->hasMany(Supervisor::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function approvedTrainings(){
        return $this->belongsToMany(Training::class, 'training_university');
    }
}
