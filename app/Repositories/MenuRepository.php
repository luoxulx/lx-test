<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/20
 * Time: 12:11
 */

namespace App\Repositories;


use App\Models\Menu;

class MenuRepository extends BaseRepository
{

    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }
}
