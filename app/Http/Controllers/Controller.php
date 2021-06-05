<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /** @OA\Info(
        *      version="1.0.0",
        *      title="L5 OpenApi",
        *      description="L5 Swagger OpenApi description",
        *      @OA\Contact(
        *          email=""
        *      ),
        *     @OA\License(
        *         name="Apache 2.0",
        *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
        *     )
        * )
        */

        /**
 * @OA\Get(
 *      path="/actualites",
 *      operationId="getActualitesList",
 *      tags={"Actualites"},
 *      summary="Get list of actualites",
 *      description="Returns list of actualites",
 *      @OA\Parameter(
 *          name="actualite",
 *          description="actualite id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *       
 *     )
 *
 * Returns list of actualites
 */
/** 
* @OA\Put(
    *      path="/actualites",
    *      operationId="getActualitesList",
    *      tags={"Actualites"},
    *      summary="modify actualites",
    *      description="return modified actualite",
    *      @OA\Parameter(
    *          name="actualite",
    *          description="actualite id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="successful operation"
    *       ),
    *       
    *     )
    *
    * Returns list of actualites
    */

}
