<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/23
 * Time: 01:12
 */

namespace App\Tools;

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class QiniuFileManager
{
    protected $accessKey;
    protected $secretKey;
    protected $bucketName;
    protected $auth;

    public function __construct()
    {
        $this->accessKey = config('my.QNConfig.ak');
        $this->secretKey = config('my.QNConfig.sk');
        $this->bucketName = config('my.QNConfig.bucket');

        $this->auth = new Auth($this->accessKey, $this->secretKey);
    }

    public function uploadToken()
    {
        // $uploadMgr = new UploadManager();
        // 生成上传Token
       return $this->auth->uploadToken($this->bucketName);
    }

    public function uploadToBucket($key, $data, $params = null)
    {
        $upToken = $this->uploadToken();
        $uploadMgr = new UploadManager();

        list($ret, $err) = $uploadMgr->put($upToken, $key, $data, $params);

        return $err || $ret;
    }

    public function putToBucket()
    {
        $upToken = $this->uploadToken();
        $uploadMgr = new UploadManager();

        list($ret, $err) = $uploadMgr->putFile($upToken, 'xxx', 'xxx');
        if ($err !== null) {
            var_dump($err);
        } else {
            var_dump($ret);
        }
        return [];
    }

    public function fileList()
    {
        $bucketManager = new BucketManager($this->auth);

        $prefix = '';
        // 上次列举返回的位置标记，作为本次列举的起点信息。
        $marker = '';
        // 本次列举的条目数
        $limit = 100;
        $delimiter = '/';

        list($ret, $err) = $bucketManager->listFiles($this->bucketName, $prefix, $marker, $limit, $delimiter);
        if ($err !== null) {
            echo "\n====> list file err: \n";
            var_dump($err);
        } else {
            if (array_key_exists('marker', $ret)) {
                echo "Marker:" . $ret["marker"] . "\n";
            }
            echo "\nList Iterms====>\n";
            //var_dump($ret['items']);
        }
        return [];
    }

    public function grabNetFileAndSave($remoteUrl)
    {
        $bucketManager = new BucketManager($this->auth);
        $key = md5(implode('-', array(time(), str_random(8)))) . getFileSuffix($remoteUrl);
        list($ret, $err) = $bucketManager->fetch($remoteUrl, $this->bucketName, $key);
        echo "=====> fetch $remoteUrl to bucket: $this->bucketName  key: $key\n";
        if ($err !== null) {
            var_dump($err);
        } else {
            print_r($ret);
        }
        return [];
    }

    public function UpdateMirroringContent()
    {
        $config = new \Qiniu\Config();
        $bucketManager = new BucketManager($this->auth, $config);

        $keys = array(
            'qiniu.mp4',
            'qiniu.png',
            'qiniu.jpg'
        );
        $ops = $bucketManager->buildBatchStat($this->bucketName, $keys);
        list($ret, $err) = $bucketManager->batch($ops);
        if ($err) {
            print_r($err);
        } else {
            print_r($ret);
        }
        return [];
    }

}
