<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

/**
 * @SWG\Swagger(
 *     basePath="/api",
 *     host=API_HOST,
 *     schemes=API_SCHEMES,
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *          @SWG\Info(
 *              title="Opal CRM",
 *              version="1.0",
 *              description="Swagger creates human-readable documentation for your APIs.",
 *              @SWG\Contact(name="Kloudportal Opal Team",email="contactus@kloudportal.com"),
 *              @SWG\License(name="Unlicense")
 *          ),
 *          @SWG\Definition(
 *              definition="Timestamps",
 *              @SWG\Property(
 *                  property="created_at",
 *                  type="string",
 *                  format="date-time",
 *                  description="Creation date",
 *                  example="2017-03-01 00:00:00"
 *              ),
 *              @SWG\Property(
 *                  property="updated_at",
 *                  type="string",
 *                  format="date-time",
 *                  description="Last updated",
 *                  example="2017-03-01 00:00:00"
 *              )
 *          )
 * )
 */

class Controller extends BaseController
{
    //
}
