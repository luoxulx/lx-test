<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/1
 * Time: 上午1:14
 */

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;

class FrontendController extends Controller
{

    protected $tags;

    public function __construct()
    {
        $this->tags = [['id'=>1,'name'=>'Mingzi']];
    }
}
