<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;
    protected $guarded=[];

    public function getDealAuth()
    {
        return $this->hasMany(Deal::class,'author_id','id');
    }

    public function getDealExecute()
    {
        return $this->hasMany(Deal::class,'executor_id','id');
    }

    public function getApplications()
    {
        return $this->hasMany(Application::class,'executor_id','id');
    }

}
