<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getExecutor()
    {
        return $this->hasOne(User::class,'id','executor_id');
    }

    public function getDeal()
    {
        return $this->hasOne(Deal::class,'id','deal_id');
    }

}
