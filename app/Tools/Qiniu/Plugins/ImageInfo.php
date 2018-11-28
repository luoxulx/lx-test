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
 * Class ImageInfo
 * 查看图像属性 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->imageInfo('foo/bar1.css'); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class ImageInfo extends AbstractPlugin {

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'imageInfo';
    }

    public function handle($path = null)
    {
        return $this->filesystem->getAdapter()->imageInfo($path);
    }
}
