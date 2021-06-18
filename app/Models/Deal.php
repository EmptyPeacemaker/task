<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getAuthor()
    {
        return $this->hasOne(User::class,'id','author_id');
    }

    public function getExecutor()
    {
        return $this->hasOne(User::class,'id','executor_id');
    }

    public function getStatus()
    {
        return $this->hasOne(Status::class,'id','status_id');
    }

}
