<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity_log';
    protected $fillable = [
        'user_id',
        'text',
        'source_type',
        'source_id',
        'action',
    ];
    protected $guarded = ['id'];

    /**
     * Get the user that the activity belongs to.
     *
     * @return object
     */
    public function activities()
    {
        return $this->belongsTo(Activities::class, 'activity_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function source() {
        return $this->morphTo();
    }
}
