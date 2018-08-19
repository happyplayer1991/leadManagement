<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Quotation extends Model
{
    protected $table = "quotations";
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
