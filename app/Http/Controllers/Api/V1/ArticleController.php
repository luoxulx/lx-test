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
use Illuminate\Http\Request;

class ArticleController extends ApiController
{

    protected $article;

    public function __construct(ArticleRepository $articleRepository)
    {
        parent::__construct();
        $this->article = $articleRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        // $page = $request->get('page');
        $limit = $request->get('limit', 10);
        $sortOrderBy = $request->get('sort', 'id,desc');
        $sort = explode(',', $sortOrderBy,2);

        return $this->response->collection($this->article->page($limit, $sort), new ArticleTransformer());
    }

    public function store(Request $request)
    {
        return $this->response->withCreated($this->article->store($request->all()), new ArticleTransformer());
    }

    public function update(Request $request, $id)
    {
        return $this->response->withPutted($this->article->update($id, $request->all()), new ArticleTransformer());
    }

    public function destroy($id)
    {
        $this->article->destroy($id);
        return $this->response->withNoContent();
    }
}
