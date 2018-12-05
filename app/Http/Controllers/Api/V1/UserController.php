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

    public function user_info(): \Illuminate\Http\JsonResponse
    {
        return $this->response->json([
            'roles'=>['admin'],
            'introduction'=>'test-test-14k',
            'avatar'=>'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
            'name'=>'14k'
        ]);
    }


    public function transaction_list(): \Illuminate\Http\JsonResponse
    {
        $data = [];
        for ($i = 1;$i <= 20; $i++) {
            $data[$i]['order_no'] = v4UUID('test');
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
        return $this->response->json($result);
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $per_page = $request->get('per_page', 10);
        return $this->response->collection($this->user->paginate($per_page), new UserTransformer);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (Request $request): \Illuminate\Http\JsonResponse
    {
        $this->user->create($request->all());
        return $this->response->withCreated();
    }

    public function update($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $this->user->update($id, $request->all());
        return $this->response->withPutted();
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $this->user->destroy($id);
        return $this->response->withNoContent();
    }
}
