<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/17
 * Time: 下午23:55
 */

namespace App\Repositories;


use App\Models\Tag;

class TagRepository extends BaseRepository
{

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }
}
