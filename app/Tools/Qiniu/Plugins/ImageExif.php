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
 * Class ImageExif
 * 查看图像EXIF <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->imageExif('foo/bar1.css'); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class ImageExif extends AbstractPlugin {

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'imageExif';
    }

    public function handle($path = null)
    {
        return $this->filesystem->getAdapter()->imageExif($path);
    }
}
