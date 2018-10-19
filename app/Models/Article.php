<?php
/**
 * Created by PhpStorm.
 * User: luoxulxT
 * Date: 2018/10/17
 * Time: 23:39
 */

namespace App\Models;


class Article extends Models
{

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'source',
        'description',
        'thumbnail',
        'content',
    ];

    protected $casts = [
        'content' => 'array'
    ];

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
        return $this->morphMany(Tag::class,'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


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
