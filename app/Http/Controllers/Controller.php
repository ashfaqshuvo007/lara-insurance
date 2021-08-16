<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     /**
     * 
     * @OA\Info(
     *      version="1.0.0",
     *      title="MYSIG API",
     *      description="MYSIG API for Frontend",
     * )
     */

    /**
	 * @OA\SecurityScheme(
	 *     securityScheme="bearerAuth",
	 *     type="http",
	 *     scheme="bearer",
	 *     in="header",
	 *     description="JWT bearer",
	 *     bearerFormat="JWT"
	 * )
	 */
    /**
	 *  @OA\Server(
	 *      url=L5_SWAGGER_CONST_HOST,
	 *  )
	 */
    

    /**
     * @OA\ExternalDocumentation(
     *     description="Frontend Link",
     *     url="http://111.93.175.214/mysig-server/public"
     * )
     */
}
