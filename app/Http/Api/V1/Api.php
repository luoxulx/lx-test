<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:30
 */

namespace App\Http\Api\V1;

use League\Fractal\Manager;
use App\Http\Controllers\Controller;

class Api extends Controller
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
