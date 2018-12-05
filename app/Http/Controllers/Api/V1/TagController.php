<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:32
 */

namespace App\Http\Controllers\Api\V1;

use App\Repositories\TagRepository;
use App\Transformers\TagTransformer;
use Illuminate\Http\Request;

class TagController extends ApiController
{

    protected $tag;

    public function __construct(TagRepository $tagRepository)
    {
        parent::__construct();
        $this->tag = $tagRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 10);
        return $this->response->collection($this->tag->paginate($per_page), new TagTransformer());
    }

    public function store(Request $request)
    {
        return $this->response->withCreated($this->tag->create($request->all()), new TagTransformer());
    }

    public function update(Request $request, $id)
    {
        $this->tag->update($id, $request->all());
        return $this->response->withPutted();
    }

    public function destroy($id)
    {
        $this->tag->destroy($id);
        return $this->response->withNoContent();
    }
}
