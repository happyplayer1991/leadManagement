<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['name', 'size', 'path', 'file_display', 'lead_id'];

    public function leads()
    {
        $this->belongsTo(Lead::class, 'lead_id');
    }
}
