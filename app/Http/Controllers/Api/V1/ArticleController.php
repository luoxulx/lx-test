<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:31
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\ArticleRepository;
use App\Transformers\ArticleTransformer;
use App\Http\Requests\ArticleRequest;

class ArticleController extends ApiController
{

    protected $article;

    public function __construct(ArticleRepository $articleRepository)
    {
        parent::__construct();
        $this->article = $articleRepository;
    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $per_page = intval(request()->get('per_page', 10));

        return $this->response->collection($this->article->paginate($per_page), new ArticleTransformer());
    }

    public function show($id)
    {
        return $this->response->item($this->article->getById($id), new ArticleTransformer());
    }

    public function store(ArticleRequest $request)
    {
        return $this->response->withCreated($this->article->create($request->all()), new ArticleTransformer());
    }

    public function update(ArticleRequest $request, $id)
    {
        $this->article->update($id, $request->all());

        return $this->response->withPutted();
    }

    public function destroy($id)
    {
        $this->article->destroy($id);
        return $this->response->withNoContent();
    }
}
