<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Product extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class,'user_id');
        
    }
}
