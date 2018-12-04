<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/28
 * Time: 23:39
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{

    protected $article;

    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    public function index()
    {
        $articles = $this->article->page(10);
//        $articles = Cache::remember('test_post',10,function(){
//            return $this->article->page(10);
//        });

        return view('article.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = $this->article->getBySlug($slug);

        return view('article.detail', compact('article'));
    }
}
