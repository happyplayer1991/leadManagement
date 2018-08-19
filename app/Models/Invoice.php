<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'lead_id',
        'user_id'
    ];

    public function leads()
    {
        return $this->belongsToMany(Lead::class);
    }

    public function tasktime()
    {
        return $this->belongsToMany(TaskTime::class);
    }
}
