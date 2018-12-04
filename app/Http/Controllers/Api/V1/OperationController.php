<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/3
 * Time: 23:43
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\OperationLogRepository;
use App\Transformers\OperationLogTransformer;
use Illuminate\Http\Request;

class OperationController extends ApiController
{

    protected $operation;

    public function __construct(OperationLogRepository $operationLogRepository)
    {
        parent::__construct();
        $this->operation = $operationLogRepository;
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 10);

        return $this->response->collection($this->operation->page($per_page), new OperationLogTransformer());
    }
}
