<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/2/1
 * Time: 下午1:24
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'filename',
        'original_name',
        'mime',
        'size',
        'real_path',
        'relative_url',
        'url'
    ];
}
