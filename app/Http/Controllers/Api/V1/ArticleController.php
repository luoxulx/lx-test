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
        $per_page = intval($request->get('per_page', 10));

        return $this->response->collection($this->article->paginate($per_page), new ArticleTransformer());
    }

    public function show($id)
    {
        return $this->response->item($this->article->getById($id), new ArticleTransformer());
    }

    public function store(Request $request)
    {
        $this->articleValidator($request->all())->validate();

        return $this->response->withCreated($this->article->create($request->all()), new ArticleTransformer());
    }

    public function update(Request $request, $id)
    {
        $this->articleValidator($request->all())->validate();
        $this->article->update($id, $request->all());

        return $this->response->withPutted();
    }

    public function destroy($id)
    {
        $this->article->destroy($id);
        return $this->response->withNoContent();
    }
}
