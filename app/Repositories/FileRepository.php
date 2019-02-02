<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/2/1
 * Time: 下午1:27
 */

namespace App\Repositories;

use App\Models\File;

class FileRepository extends BaseRepository
{
    public function __construct(File $file)
    {
        $this->model = $file;
    }

    public function recordUpload($data)
    {
        $this->model->fill($data);
        return $this->model->save();
    }
}
