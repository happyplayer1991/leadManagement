<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Taxs extends Model
{
    protected $table = 'tax_rate';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
