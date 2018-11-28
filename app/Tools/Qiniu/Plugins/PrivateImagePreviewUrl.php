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
 * Class PrivateImagePreviewUrl
 * 获取私有bucket图片预览URL <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->privateImagePreviewUrl('foo/bar1.css',$ops); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class PrivateImagePreviewUrl extends AbstractPlugin {

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'privateImagePreviewUrl';
    }

    public function handle($path = null, $ops = null)
    {
        return $this->filesystem->getAdapter()->privateImagePreviewUrl($path, $ops);
    }
}
