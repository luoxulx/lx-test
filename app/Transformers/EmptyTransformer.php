<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/16
 * Time: 下午23:55
 */

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class EmptyTransformer extends TransformerAbstract
{
    /**
     * Transform a collection.
     *
     * @return array
     */
    public function transform()
    {
        return [];
    }
}
