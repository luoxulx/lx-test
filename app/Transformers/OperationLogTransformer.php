<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/26
 * Time: 01:21
 */

namespace App\Transformers;


use App\Models\OperationLog;
use League\Fractal\TransformerAbstract;

class OperationLogTransformer extends TransformerAbstract
{

    public function transform(OperationLog $operationLog)
    {
        return $operationLog->attributesToArray();
    }
}
