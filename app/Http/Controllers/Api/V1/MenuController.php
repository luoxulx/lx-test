<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/20
 * Time: 01:19
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\MenuRepository;
use App\Transformers\MenuTransformer;

class MenuController extends ApiController
{

    protected $menu;
    public function __construct(MenuRepository $menuRepository)
    {
        parent::__construct();
        $this->menu = $menuRepository;
    }

    public function index()
    {
        return $this->response->collection($this->menu->page(10), new MenuTransformer());
    }


}
