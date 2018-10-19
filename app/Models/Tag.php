<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/17
 * Time: 下午23:25
 */

namespace App\Models;


class Tag extends Models
{

    protected $fillable = [
        'name',
        'color',
        'style',
        'description',
    ];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
}
