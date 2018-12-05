<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:32
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\CategoryRepository;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{

    protected $category;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->category = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 10);
        return $this->response->collection($this->category->paginate($per_page), new CategoryTransformer());
    }

    public function store(Request $request)
    {
        return $this->response->withCreated($this->category->create($request->all()), new CategoryTransformer());
    }

    public function update(Request $request, $id)
    {
        $this->category->update($id, $request->all());
        return $this->response->withPutted();
    }

    public function destroy($id)
    {
        $this->category->destroy($id);
        return $this->response->withNoContent();
    }
}
