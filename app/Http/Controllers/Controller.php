<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**

 *@OA\Info(
 *title="Example API",
 *version="1.0.0",

 *),
 *@OA\SecurityScheme(
 *securityScheme="bearerAuth",
 *in="header",
 *name="na",
 *type="http",
 *scheme="bearer",
 *bearerFormat="JWT",
 *)
 *  * @OA\Components(
 *     schemas={
 *         @OA\Schema(
 *             schema="User",
 *             required={"id", "name", "email", "password"},
 *             @OA\Property(property="id", type="integer", format="int64", description="The unique identifier for the user"),
 *             @OA\Property(property="name", type="string", description="The name of the user"),
 *             @OA\Property(property="email", type="string", format="email", description="The email address of the user"),
 *             @OA\Property(property="password", type="string", format="password", description="The password of the user"),
 *         ),
 *     }
 * 
 *)
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
