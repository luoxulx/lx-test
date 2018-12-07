<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:39
 */

namespace App\Models;

use App\Scopes\DraftScope;

class Article extends Models
{

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
    public function setContentAttribute($value)
    {
        $data = [
            'raw'  => strip_tags($value),
            'html' => $value
        ];
        $this->attributes['content'] = json_encode($data);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $pinyin = '';

        if (!config('my.bd_translate.app_id') || !config('my.bd_translate.secret_key')) {

            if (preg_match('/[a-zA-Z]/',$value)){
                $pinyin = strval($value);
            }else {
                $pinyin = zh_to_pinyin($value);
            }

            $this->setUniqueSlug($pinyin, '');
        } else {
            $pinyin = bd_translate($value);
            $this->setUniqueSlug($pinyin, '');
        }
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
