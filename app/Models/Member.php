<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Authenticatable
{

    use HasFactory , SoftDeletes;

    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function organization(){
        return $this->hasOne(Organization::class);
    }

    public function student(){
        return $this->hasOne(Student::class);
    }

    public function supervisor(){
        return $this->hasOne(Supervisor::class);
    }
}
