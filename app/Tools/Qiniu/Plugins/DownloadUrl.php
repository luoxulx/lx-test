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
 * Class DownloadUrl
 * 得到公有资源下载地址 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->downloadUrl('foo/bar1.css'); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class DownloadUrl extends AbstractPlugin
{

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'downloadUrl';
    }

    public function handle($path = null, $domainType = 'default')
    {
        $adapter = $this->filesystem->getAdapter();
        return $adapter->downloadUrl($path, $domainType);
    }
}
