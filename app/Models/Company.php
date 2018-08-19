<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Company extends Model
{
	protected $table = 'company';

	protected $fillable = ['company_id','type','subtype','value','description'];

	protected $dates = ['created_date', 'updated_date'];
}