<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/16
 * Time: 下午8:17
 */

namespace App\Tools\FileManage;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class QiniuManage extends BaseFileManage
{


    public function fileExist($key)
    {
        return $this->disk->exists($key);
    }

    public function get($key)
    {
        return $this->disk->get($key);
    }

    public function store(UploadedFile $file, $dir = '', $name = '')
    {
        $hashName = empty($name)
            ? str_ireplace('.jpeg', '.jpg', $file->hashName())
            : $name;

        $mime = $file->getMimeType();

        $realPath = $this->disk->putFileAs($dir, $file, $hashName);

        $style = 'imageView2/0/q/75|watermark/2/text/aHR0cHM6Ly93d3cubG5tcGEudG9w/font/c2Vnb2Ugc2NyaXB0/fontsize/640/fill/IzUyMTJBNQ==/dissolve/100/gravity/SouthEast/dx/10/dy/10|imageslim';

        return [
            'success' => true,
            'filename' => $hashName,
            'original_name' => $file->getClientOriginalName(),
            'mime' => $mime,
            'size' => human_filesize($file->getClientSize()),
            'real_path' => $realPath,
            'relative_url' => $realPath,
            'url' => $this->disk->getDriver()->imagePreviewUrl($realPath, $style),
            'url_s' => $this->disk->getDriver()->downloadUrl($realPath, 'https'),
        ];
    }

    public function prepend($key, $content)
    {
        return $this->disk->prepend($key, $content);
    }
}
