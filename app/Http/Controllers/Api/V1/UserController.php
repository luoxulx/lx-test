<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/23
 * Time: 01:03
 */

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\UserRequest;
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
            'name'=>'14k.Frankenstein',
            'userid' => 1,
            'email' => 'xxx@qq.com',
            'roles'=>['admin'],
            'avatar'=>'https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png',
            'signature' => 'signature signature signature signature',
            'introduction'=>'14k.Frankenstein',
            'title' => 'title',
            'group' => 'group',
            'tags' => [
                ['key' => 0, 'label' => '测试1'],
                ['key' => 1, 'label' => '测试2'],
                ['key' => 2, 'label' => '测试3'],
                ['key' => 3, 'label' => '测试4'],
                ['key' => 4, 'label' => '测试5'],
                ['key' => 5, 'label' => '测试6'],
                ['key' => 6, 'label' => '测试7'],
                ['key' => 7, 'label' => '测试8']
            ],
            'notifyCount' => 12,
            'country' => 'China',
            'geographic' => [
                'province' => ['label' => '浙江', 'key' => '330000'],
                'city' => ['label' => '杭州', 'key' => '330100']
            ],
            'address' => '杭州市滨江区长河镇长一村22-2号',
            'phone' => '23561-32132132'
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

    public function show($id)
    {
        return $this->response->item($this->user->getById($id), new UserTransformer());
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (UserRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->user->create($request->all());
        return $this->response->withCreated($this->user->create($request->all()), new UserTransformer());
    }

    public function update($id, UserRequest $request): \Illuminate\Http\JsonResponse
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
