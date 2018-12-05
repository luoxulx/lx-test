<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/28
 * Time: 23:38
 */

namespace App\Http\Controllers\Front;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    protected $article;

    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    public function index()
    {
        $articles = $this->article->paginate(10);

        return view('home.index', compact('articles'));
    }


    /**
     * common data method
     * @param \Illuminate\View\View $view
     */
    public static function common_data(View $view): void
    {
        $data = [];
        $data['all_tags'] = Cache::remember(__CLASS__.'-all_tags', 10, function () {
            return Tag::all(['id','name','color','style','description'])->toArray();
        });
        $data['all_categories'] = Cache::remember(__CLASS__.'-all_categories', 10, function () {
            return Category::all(['id','parent_id','name','description','thumbnail'])->toArray();
        });

        $view->with('common_data', $data);
    }
}
