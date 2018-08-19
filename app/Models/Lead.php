<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon;

/**
 * @SWG\Definition(
 *     definition="NewLead",
 *     required={"name", "email", "primary_number", "lead_type","user_id","company_id","lead_stage"},
 *     @SWG\Property(
 *          property="name",
 *          type="string",
 *          description="Lead name",
 *          example="John"
 *    ),
 *     @SWG\Property(
 *          property="email",
 *          type="string",
 *          description="Lead Email",
 *          example="john@gamil.com"
 *    ),
 *     @SWG\Property(
 *          property="primary_number",
 *          type="string",
 *          description="Lead mobile number",
 *          example="1234567890"
 *    ),
 *     @SWG\Property(
 *          property="lead_type",
 *          type="string",
 *          description="Lead type",
 *          example="hot"
 *    ),
 *     @SWG\Property(
 *          property="user_id",
 *          type="string",
 *          description="User who creates the Lead",
 *          example="1"
 *    ),
        @SWG\Property(
 *          property="company_id",
 *          type="string",
 *          description="Company who created the lead",
 *          example="123468976"
 *    ),
        @SWG\Property(
 *          property="lead_stage",
 *          type="string",
 *          description="Lead Stage",
 *          example="Lead"
 *    )
 * )
 * @SWG\Definition(
 *     definition="Lead",
 *     allOf = {
 *          { "$ref": "#/definitions/NewLead" },
 *          { "$ref": "#/definitions/Timestamps" },
 *          { "required": {"id"} }
 *     }
 * )
 */


class Lead extends Model
{
       protected $fillable = [
        'name',
        'email',
        'company_name',
        'primary_number',
        'secondary_number',
        'address',
        'pin',
        'fax',
        'country',
        'source_id',
        'lead_type',
        'company_website',
        'annual_revenue',
        'number_employee',
        'industry_id',
        'drop_status',
        'lead_stage',
        'comment',
        'interested_product',
        'company_id',
        'lead_number',
         'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

   public function activities()
    {
        return $this->hasMany(Activities::class, 'lead_id', 'id')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc');
    }


    public function documents()
    {
        return $this->hasMany(Document::class, 'client_id', 'id');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }

    public function getAssignedUserAttribute()
    {
        return User::findOrFail($this->user_id);
    }
}
