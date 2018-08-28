<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'notifiable_id',
        'notifiable_type',
        'data',
        'read_at',
        'company_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
