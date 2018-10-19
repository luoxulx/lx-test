<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:32
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\CommentRepository;

class CommentController extends ApiController
{

    protected $comment;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->comment = $commentRepository;
    }
}
