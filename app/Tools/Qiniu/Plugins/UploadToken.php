<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/27
 * Time: 01:05
 */

namespace App\Tools\Qiniu\Plugins;


use League\Flysystem\Plugin\AbstractPlugin;

/**
 * Class UploadToken
 * 获取上传Token <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->uploadToken('foo/bar1.css'); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class UploadToken extends AbstractPlugin {

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'uploadToken';
    }

    public function handle($path = null, $expires = 3600, $policy = null, $strictPolicy = true)
    {
        return $this->filesystem->getAdapter()->uploadToken($path, $expires, $policy, $strictPolicy);
    }
}
