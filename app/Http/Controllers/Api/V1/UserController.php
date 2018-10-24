<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/23
 * Time: 01:03
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\UserRepository;

class UserController extends ApiController
{

    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->user = $userRepository;
    }

    public function user_info()
    {

        return response()->json([
            'roles'=>['admin'],
            'token'=>'xadmin',
            'introduction'=>'admin',
            'avatar'=>'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
            'name'=>'admin'
        ]);
    }
}
