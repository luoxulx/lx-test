<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:30
 */

namespace App\Http\Controllers\Api\V1;

use League\Fractal\Manager;
use App\Support\Response;
use App\Support\Transform;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $response;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {

        $manager = new Manager();

        $this->response = new Response(response(), new Transform($manager));
    }
}
