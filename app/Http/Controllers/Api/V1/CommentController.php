<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:32
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\CommentRepository;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;

class CommentController extends ApiController
{

    protected $comment;

    public function __construct(CommentRepository $commentRepository)
    {
    	parent::__construct();
        $this->comment = $commentRepository;
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 10);
        return $this->response->collection($this->comment->page($per_page), new CommentTransformer());
    }

    public function destory($id)
    {
        $this->comment->destroy($id);
        return $this->response->withNoContent();
    }
}
