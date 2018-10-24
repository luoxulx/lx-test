<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/24
 * Time: 20:59
 */

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class StatusScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->where('status', 1);
    }
}
