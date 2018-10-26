<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/26
 * Time: 01:23
 */

namespace App\Repositories;


use App\Models\OperationLog;

class OperationLogRepository
{

    use BaseRepository;

    protected $model;

    public function __construct(OperationLog $operationLog)
    {
        $this->model = $operationLog;
    }

}
