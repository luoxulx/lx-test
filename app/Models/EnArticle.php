<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/4
 * Time: 23:35
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnArticle
 *
 * @property int $article_id 关联article ID
 * @property string|null $title en title
 * @property string|null $source en source
 * @property string|null $description en description
 * @property string|null $content en content
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnArticle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnArticle whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnArticle whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnArticle whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnArticle whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnArticle whereTitle($value)
 * @mixin \Eloquent
 */
class EnArticle extends Model
{

    protected $table = 'en_articles';
//    public function zhInfo()
//    {
//        return $this->belongsTo(Article::class);
//    }
}
