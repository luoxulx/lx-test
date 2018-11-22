<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/23
 * Time: 01:03
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

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
            'introduction'=>'adminxx',
            'avatar'=>'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
            'name'=>'adminsx'
        ]);
    }

    public function transaction_list()
    {
        $data = [];
        for ($i = 1;$i <= 20; $i++) {
            $data[$i]['order_no'] = str_random(8).'-'.str_random(8).'-'.str_random(8);
            $data[$i]['timestamp'] = time();
            $data[$i]['username'] = str_random(8);
            $data[$i]['price'] = round(randomFloat(650,15000), 3);
            if ($i % 2) {
                $data[$i]['status'] = 'success';
            } else {
                $data[$i]['status'] = 'pending';
            }
        }
        $result['total'] = \count($data);
        $result['items'] = $data;
        return response()->json($result);
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 10);
        return $this->response->collection($this->user->page($per_page), new UserTransformer);
    }

    public function store ()
    {
        return $this->response->withCreated();
    }

    public function update()
    {
        return $this->response->withPutted();
    }

    public function destory()
    {
        return $this->response->withNoContent();
    }
}
