<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/22
 * Time: 11:12
 */

namespace App\Models;


class OperationLog extends Models
{

    protected $fillable = [
        'user_id',
        'path',
        'method',
        'input',
        'ip'
    ];
}
