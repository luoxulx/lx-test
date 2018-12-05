<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/18
 * Time: 下午11:45
 */

namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
