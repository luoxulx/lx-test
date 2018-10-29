<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/28
 * Time: 23:39
 */

namespace App\Http\Controllers\Front;

use App\Repositories\ArticleRepository;

class ArticleController extends FrontController
{

    protected $article;

    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    public function index()
    {
        $articles = $this->article->page(10);

        return view('article.index', compact('articles'));
    }

    public function show()
    {
        $article = $this->article->getById(1);

        return view('article.detail', compact('article'));
    }
}
