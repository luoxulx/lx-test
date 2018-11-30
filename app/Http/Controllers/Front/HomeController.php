<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/28
 * Time: 23:38
 */

namespace App\Http\Controllers\Front;

use App\Repositories\ArticleRepository;

class HomeController extends FrontendController
{

    protected $article;

    public function __construct(ArticleRepository $article)
    {
        parent::__construct();
        $this->article = $article;
    }

    public function index()
    {
        $articles = $this->article->page(10);
        $tags = $this->tags;

        return view('home.index', compact('articles', 'tags'));
    }
}
