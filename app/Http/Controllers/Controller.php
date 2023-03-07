<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 /** 
     * @OA\Info( 
     * version="1.0.0", 
     * title="Laravel OpenApi Cocumentação", 
     * description="To criando uma API que vai ter 2 tipo de login, o primeiro e login normal com email e senha e o outro e login com google com isso vai ter acesso as rotas que vai ser rotas do ADM e do USUARIO.", 
     * @OA\Contact( 
     * email= "admin@admin.com" 
     * ), 
     * @OA\License( 
     * name="Apache 2.0", 
     * url="http://www.apache.org/licenses/LICENSE-2.0.html" 
     * ) 
     * ) 
     * 
     * @OA\Server( 
     * url=L5_SWAGGER_CONST_HOST, 
     * description="URL da API"
     * ) 
     * @OA\SecurityScheme(
     *      type="http",
     *      scheme="bearer",
     *      securityScheme="bearerAuth",
     * )
     */ 
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
