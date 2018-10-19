<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:31
 */

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticleRepository;
use App\Transformers\ArticleTransformer;

class ArticleController extends ApiController
{

    protected $article;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->article = $articleRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        return $this->response->collection($this->article->page(), new ArticleTransformer());
    }

    public function store(ArticleRequest $request)
    {
        return $this->response->withCreated($this->article->store($request->all()), new ArticleTransformer());
    }

    public function update(ArticleRequest $request, $id)
    {
        return $this->response->withPutted($this->article->update($id, $request->all()), new ArticleTransformer());
    }

    public function destroy($id)
    {
        $this->article->destroy($id);
        return $this->response->withNoContent();
    }
}
