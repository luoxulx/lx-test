<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/27
 * Time: 23:49
 */

namespace App\Tools\Qiniu;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use App\Tools\Qiniu\Plugins\DownloadUrl;
use App\Tools\Qiniu\Plugins\Fetch;
use App\Tools\Qiniu\Plugins\ImageExif;
use App\Tools\Qiniu\Plugins\ImageInfo;
use App\Tools\Qiniu\Plugins\AvInfo;
use App\Tools\Qiniu\Plugins\ImagePreviewUrl;
use App\Tools\Qiniu\Plugins\LastReturn;
use App\Tools\Qiniu\Plugins\PersistentFop;
use App\Tools\Qiniu\Plugins\PersistentStatus;
use App\Tools\Qiniu\Plugins\PrivateDownloadUrl;
use App\Tools\Qiniu\Plugins\Qetag;
use App\Tools\Qiniu\Plugins\UploadToken;
use App\Tools\Qiniu\Plugins\PrivateImagePreviewUrl;
use App\Tools\Qiniu\Plugins\VerifyCallback;
use App\Tools\Qiniu\Plugins\WithUploadToken;


class QiniuFilesystemServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend(
            'qiniu',
            function ($app, $config) {
//                if (isset($config['domains'])) {
//                    $domains = $config['domains'];
//                } else {
//                    $domains = [
//                        'default' => $config['domain'],
//                        'https'   => null,
//                        'custom'  => null
//                    ];
//                }

                $qiniu_adapter = new QiniuAdapter(
                    $config['access_key'],
                    $config['secret_key'],
                    $config['bucket'],
                    $config['domains'],
                    isset($config['notify_url']) ? $config['notify_url'] : null,
                    isset($config['access']) ? $config['access'] : 'public',
                    isset($config['hotlink_prevention_key']) ? $config['hotlink_prevention_key'] : null
                );
                $file_system = new Filesystem($qiniu_adapter);
                $file_system->addPlugin(new PrivateDownloadUrl());
                $file_system->addPlugin(new DownloadUrl());
                $file_system->addPlugin(new AvInfo());
                $file_system->addPlugin(new ImageInfo());
                $file_system->addPlugin(new ImageExif());
                $file_system->addPlugin(new ImagePreviewUrl());
                $file_system->addPlugin(new PersistentFop());
                $file_system->addPlugin(new PersistentStatus());
                $file_system->addPlugin(new UploadToken());
                $file_system->addPlugin(new PrivateImagePreviewUrl());
                $file_system->addPlugin(new VerifyCallback());
                $file_system->addPlugin(new Fetch());
                $file_system->addPlugin(new Qetag());
                $file_system->addPlugin(new WithUploadToken());
                $file_system->addPlugin(new LastReturn());
                return $file_system;
            }
        );
    }
    public function register()
    {
        //
    }
}
