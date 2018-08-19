<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Product extends Model
{
    protected $table = "products";
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
