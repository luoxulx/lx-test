<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/2/1
 * Time: 下午1:26
 */

namespace App\Transformers;

use App\Models\File;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{
    public function transform(File $file)
    {
        return $file->attributesToArray();
    }
}
