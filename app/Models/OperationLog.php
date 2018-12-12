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

    protected $table = 'operation_logs';

    protected $fillable = [
        'user_id',
        'path',
        'method',
        'ip',
        'request',
        'jwt_auth'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public static $methodColors = [
        'GET'    => 'green',
        'POST'   => 'yellow',
        'PUT'    => 'blue',
        'DELETE' => 'red',
    ];

    public static $methods = [
        'GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH',
        'LINK', 'UNLINK', 'COPY', 'HEAD', 'PURGE',
    ];

}
