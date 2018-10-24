<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/18
 * Time: 下午11:39
 */

namespace App\Transformers;


use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{

    public function transform(Article $article)
    {
        $res = $article->attributesToArray();
        $res['tags'] = $article->tags()->pluck('id');
        $res['category'] = $article->category()->pluck('id');
        return $res;
    }
}
