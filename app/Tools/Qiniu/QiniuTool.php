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

    public function uploadToken()
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
    public function put($path, $binaryData, $ext)
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

    public function putFile($path, $binaryData, $ext)
    {
        $filename = $this->filenameRandom($ext);
        $key = $path.$filename;

        $result = $this->disk->putFile($this->token, $key, $binaryData);

        $pic_style = config('my.QNConfig.pic_style');
        $domain = config('my.QNConfig.domain');

        $temp = [];
        foreach ($pic_style as $key=>$val) {
            $temp[$key] = $domain . $result[0]['key'] . $val;
        }

        return $temp;
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

        $domain = config('my.QNConfig.domain');

        foreach ($list[0]['items'] as $key=>$val)
        {
            $list[0]['items'][$key]['url'] = 'http://cdn.lnmpa.top/' . $val['key'] . '-thumbnail640x640';
        }

        return $list[0]['items'];
    }

    public function deleteOriginFile($filename)
    {
        $bucketMgr = new BucketManager($this->auth);
        return $bucketMgr->delete(config('my.QNConfig.bucket'), $filename);
    }


    public function filenameRandom($ext = '')
    {
        if ($ext) {
            return hash('ripemd160', uniqid('laravel_', true).time()).'.'.$ext;
        }
        else {
            return hash('ripemd160', uniqid('laravel_', true).time());
        }
    }
}
