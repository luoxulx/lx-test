<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/28
 * Time: 23:38
 */

namespace App\Tools\Qiniu;


use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class QiniuTool
{

    private $token;
    private $auth;

    private $disk;

    public function __construct()
    {
        $this->auth = new Auth(config('my.QNConfig.ak'), config('my.QNConfig.sk'));
        $this->token = $this->auth->uploadToken(config('my.QNConfig.bucket'));
        $this->disk = new UploadManager();
    }

    /**
     * 返回上传token
     * @return string
     */
    public function uploadToken(): string
    {
        return $this->token;
    }

    /**
     * 二进制流上传,几乎没用到
     * @param $path
     * @param $binaryData
     * @param $ext
     * @return array
     */
    public function put($path, $binaryData, $ext): array
    {
        $filename = $this->filenameRandom($ext);
        $key = $path.$filename;

        $result = $this->disk->put($this->token, $key, $binaryData);

        $pic_style = config('my.QNConfig.pic_style');
        $domain = config('my.QNConfig.domain');

        $temp = [];
        foreach ($pic_style as $key=>$val) {
            $temp[$key] = $domain . $result[0]['key'] . $val;
        }

        return $temp;
    }

    /**
     * 文件上传
     * @param $path 路径/
     * @param $binaryData
     * @param $ext
     * @return array
     */
    public function putFile($path, $binaryData, $ext): array
    {
        $filename = $this->filenameRandom($ext);
        $key = $path.$filename;

        $result = $this->disk->putFile($this->token, $key, $binaryData);

        return ['hash'=>$result[0]['hash'], 'url'=>$result[0]['key']];
    }

    /**
     * @param $path 公共前缀
     * @param int $limit 单次列举个数限制
     * @return mixed
     */
    public function files($path, $limit = 1000)
    {
        $bucketMgr = new BucketManager($this->auth);
        $list = $bucketMgr->listFiles(config('my.QNConfig.bucket'), $path, '', $limit, '/');

        return $list[0]['items'];
    }

    /**
     * 当前bucket下所有路径前缀
     * @return string[]
     */
    public function allDir()
    {
        $bucketMgr = new BucketManager($this->auth);
        return $bucketMgr->buckets();
    }

    /**
     * 删除远程文件
     * @param $filename filename带路径前缀
     * @return mixed
     */
    public function deleteOriginFile($filename)
    {
        $bucketMgr = new BucketManager($this->auth);
        return $bucketMgr->delete(config('my.QNConfig.bucket'), $filename);
    }

    /**
     * 生成文件名 或 文件 key
     * @param string $ext
     * @return string
     */
    public function filenameRandom($ext = ''): string
    {
        $key = hash('ripemd160', uniqid('laravel_', true).time());
        if ($ext) {
            $key .= $ext;
            // $key = hash('ripemd160', uniqid('laravel_', true).time()).'.'.$ext;
        }
        return $key;
    }


}
