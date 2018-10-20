<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/20
 * Time: 12:12
 */

namespace App\Transformers;


use App\Models\Menu;
use League\Fractal\TransformerAbstract;

class MenuTransformer extends TransformerAbstract
{

    public function transform(Menu $menu)
    {
        return $menu->attributesToArray();
    }
}
