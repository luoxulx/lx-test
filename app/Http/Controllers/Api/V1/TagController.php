<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:32
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\TagRequest;
use App\Repositories\TagRepository;
use App\Transformers\TagTransformer;

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
    public function index()
    {
        return $this->response->collection($this->tag->page(), new TagTransformer());
    }

    public function store(TagRequest $request)
    {
        return $this->response->withCreated($this->tag->store($request->all()), new TagTransformer());
    }

    public function update(TagRequest $request, $id)
    {
        return $this->response->withPutted($this->tag->update($id, $request->all()), new TagTransformer());
    }

    public function destroy($id)
    {
        $this->tag->destroy($id);
        return $this->response->withNoContent();
    }
}
