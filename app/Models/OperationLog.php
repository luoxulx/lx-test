<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/22
 * Time: 11:12
 */

namespace App\Models;


/**
 * App\Models\OperationLog
 *
 * @property int $id
 * @property int $user_id
 * @property string $path
 * @property string $method
 * @property string $ip
 * @property string $request request header && content,by json_encode
 * @property int $jwt_auth 1:jwt_auth;0:NO
 * @property string $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereJwtAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereUserId($value)
 * @mixin \Eloquent
 */
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
