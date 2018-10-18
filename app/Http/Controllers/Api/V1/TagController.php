<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:32
 */

namespace App\Http\Controllers\Api\V1;

use App\Repositories\TagRepository;

class TagController extends ApiController
{

    protected $tag;

    public function __construct(TagRepository $tagRepository)
    {
        // parent::__construct();
        $this->tag = $tagRepository;
    }
    public function index()
    {
        return $this->response->collection($this->tag->page());
    }
}
