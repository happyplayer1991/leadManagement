<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *     definition="NewActivity",
 *     required={"name", "date", "details", "lead_id","status","company_id","user_id"},
 *     @SWG\Property(
 *          property="name",
 *          type="string",
 *          description="Activity name",
 *          example="John"
 *    ),
 *              @SWG\Property(
 *                  property="date",
 *                  type="string",
 *                  format="date-time",
 *                  description="Creation date",
 *                  example="2017-03-01 00:00:00"
 *              ),
 *     @SWG\Property(
 *          property="details",
 *          type="string",
 *          description="Description",
 *          example="activity added for this lead"
 *    ),
 *     @SWG\Property(
 *          property="lead_id",
 *          type="string",
 *          description="Activity Created for particular Lead",
 *          example="1"
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
 *          property="status",
 *          type="string",
 *          description="Company who created the lead",
 *          example="Scheduled"
 *    ),
 * )
 * @SWG\Definition(
 *     definition="Activity",
 *     allOf = {
 *          { "$ref": "#/definitions/NewActivity" },
 *          { "$ref": "#/definitions/Timestamps" },
 *          { "required": {"id"} }
 *     }
 * )
 */

class Activities extends Model implements \App\Events\MyEvent
{
    protected $dates = ['start', 'end'];
    protected $table = 'activities';
    protected $fillable = [
        'name',
        'status',
        'details',
        'lead_id',
        'user_id',
        'company_id',
        'date',
        'end_date'

    ];
    /**
     * Get the event's id number
     *
     * @return int
     */
    // public function getId() {
    //     return $this->id;
    // }

    // /**
    //  * Get the event's title
    //  *
    //  * @return string
    //  */
    public function getTitle()
    {
        return $this->name;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay() {

        return $this->isAllDay;
    }
    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->date;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end_date;
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }



    public function comments()
    {
        return $this->hasMany(Comment::class, 'activity_id', 'id');
    }



    public function getAssignedUserAttribute()
    {
        return User::findOrFail($this->user_id);
    }

    public function getCreatorUserAttribute()
    {
        return User::findOrFail($this->user_id);
    }



    public function activity()
    {
        return $this->morphMany(Activity::class, 'source');
    }
}