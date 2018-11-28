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
 * Class PrivateDownloadUrl
 * 得到私有资源下载地址 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->privateDownloadUrl('foo/bar1.css'); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class PrivateDownloadUrl extends AbstractPlugin
{

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'privateDownloadUrl';
    }

    public function handle($path = null, $settings = 'default')
    {
        $adapter = $this->filesystem->getAdapter();
        return $adapter->privateDownloadUrl($path, $settings);
    }
}
