<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:31
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Models
 *
 * @property-read string $created_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Models newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Models newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Models onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Models query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Models withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Models withoutTrashed()
 * @mixin \Eloquent
 */
class Models extends Model
{

    use SoftDeletes;

    protected $hidden = [
        'deleted_at'
    ];

    /**
     * Get the created at attribute.
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }
}
