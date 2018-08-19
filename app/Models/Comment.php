<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'description',
        'activity_id',
        'user_id'
    ];
    protected $hidden = ['remember_token'];

    public function activity()
    {
        return $this->belongsTo(Activities::class, 'activity_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
