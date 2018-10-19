<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:32
 */

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Transformers\CategoryTransformer;

class CategoryController extends ApiController
{

    protected $category;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        return $this->response->collection($this->category->page(), new CategoryTransformer());
    }

    public function store(CategoryRequest $request)
    {
        return $this->response->withCreated($this->category->store($request->all()), new CategoryTransformer());
    }

    public function update(CategoryRequest $request, $id)
    {
        return $this->response->withPutted($this->category->update($id, $request->all()), new CategoryTransformer());
    }

    public function destroy($id)
    {
        $this->category->destroy($id);
        return $this->response->withNoContent();
    }
}
