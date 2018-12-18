<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/16
 * Time: 下午8:17
 */

namespace App\Tools\FileManage;

use Carbon\Carbon;

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

use Symfony\Component\HttpFoundation\File\UploadedFile;


class QiniuManage extends BaseFileManage
{

    protected $auth;

    protected $token;

    protected $qiniuDisk;


    public function __construct()
    {
        parent::__construct();

        $this->auth = new Auth(config('my.qiniu_config.ak'), config('my.qiniu_config.sk'));

        $this->token = $this->auth->uploadToken(config('my.qiniu_config.bucket'));

        $this->qiniuDisk = new UploadManager();
    }

    public function getFileList($path, $limit = 1000)
    {
        $bucketMgr = new BucketManager($this->auth);
        $list = $bucketMgr->listFiles(config('my.qiniu_config.bucket'), $path, '', $limit, '/');

        return $list[0]['items'];
    }

    public function fileDetail()
    {
        dd(1);
    }

    public function fileWebPath($path)
    {
        return $this->disk->getUrl($path);
    }


    public function fileMimeType($path)
    {
        return $this->disk->getMimetype($path);
    }


    public function fileSize($path)
    {
        return human_filesize($this->disk->getSize($path));
    }


    public function fileModified($path)
    {
        return Carbon::createFromTimestamp(
            substr($this->disk->getTimestamp($path), 0, 10)
        )->toDateTimeString();
    }

    public function createFolder($folder)
    {
        $this->cleanFolder($folder);

        if ($this->checkFolder($folder)) {
            throw new FileException('The Folder exists.');
        }

        return $this->disk->createDir($folder);
    }


    public function store(UploadedFile $file, $prefix= '', $name = '')
    {

        $hashName = empty($name)
            ? str_ireplace('.jpeg', '.jpg', $file->hashName())
            : $name;

        $mime = $file->getMimeType();

        $realPath = $this->disk->putFileAs($prefix, $file, $hashName);


    }

    public function deleteFolder()
    {
        dd(1);
    }

    public function deleteFile($path)
    {
        $bucketMgr = new BucketManager($this->auth);
        return $bucketMgr->delete(config('my.qiniu_config.bucket'), $path);
    }

    public function stat($key)
    {
        $bucketMgr = new BucketManager($this->auth);

        return $bucketMgr->stat(config('my.qiniu_config.bucket'), $key);
    }

}
