<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name',
        'description',
        'location',
        'website',
        'organization_id',
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function trainings(){
        return $this->hasMany(Training::class);
    }

}
