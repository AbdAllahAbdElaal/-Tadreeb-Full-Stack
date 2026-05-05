<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }

    public function universities(){
        return $this->belongsToMany(University::class, 'training_university');
    }
}
