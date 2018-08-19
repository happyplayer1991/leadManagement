<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
	protected $table = 'announcement';
    protected $fillable = [
            'announcement',
            'misclaneous1',
            'misclaneous2',
            'misclaneous3',
            'misclaneous4',
            'misclaneous5',
            'user_id',
            'company_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
