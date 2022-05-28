<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'position_work',
    ];

    public function user(){
        return $this->HasOne(User::class,'id','user_id');
    }
}
