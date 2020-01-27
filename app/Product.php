<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Product extends Model
{
    public function products()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
