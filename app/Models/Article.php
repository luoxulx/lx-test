<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:39
 */

namespace App\Models;


use App\Scopes\DraftScope;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Models
{

    use Sluggable;

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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

}
