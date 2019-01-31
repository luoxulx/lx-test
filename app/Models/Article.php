<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:39
 */

namespace App\Models;

use App\Scopes\DraftScope;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property int $is_draft 是否草稿
 * @property int $view_count 点击查看计数
 * @property string $title title
 * @property string $slug url slug for SEO
 * @property string|null $source 来源网址
 * @property string|null $description 描述
 * @property string|null $thumbnail 缩略图
 * @property array|null $content 主体内容json{raw,html}
 * @property string $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereIsDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereViewCount($value)
 * @mixin \Eloquent
 */
class Article extends Models
{

    protected $table = 'articles';

    protected $fillable = [
        'category_id',
        'user_id',
        'is_draft',
        'view_count',
        'title',
        'slug',
        'source',
        'description',
        'thumbnail',
        'content'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DraftScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

//    public function enInfo()
//    {
//        return $this->hasOne(EnArticle::class,'article_id','id');
//    }


    /**
     * Set the content attribute.
     *
     * @param $value
     */
    protected function setContentAttribute($value)
    {
        $data = [
            'raw'  => strip_tags($value),
            'html' => $value
        ];
        $this->attributes['content'] = json_encode($data);
    }

    protected function setTitleAttribute($value)
    {
        $pinyin = '';

        if (!config('my.bd_translate.app_id') || !config('my.bd_translate.secret_key')) {

            if (preg_match('/[a-zA-Z]/',$value)){
                $pinyin = strval($value);
            }else {
                $pinyin = zh_to_pinyin($value);
            }

            $this->setUniqueSlug($pinyin, '');
        } else {
            if (preg_match('/[a-zA-Z]/',$value)){
                $pinyin = strval($value).str_random();
            }else {
                $pinyin = bd_translate($value);
            }

            $this->setUniqueSlug($pinyin, '');
        }

        $this->attributes['title'] = $value;
    }

    protected function setUniqueSlug($value, $extra)
    {
        $slug = str_slug($value.'-'.$extra);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($slug, (int) $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }


}
