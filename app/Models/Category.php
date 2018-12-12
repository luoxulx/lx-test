<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/18
 * Time: 下午11:36
 */

namespace App\Models;


class Category extends Models
{

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'thumbnail',
    ];

    /**
     * Get the articles for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}
