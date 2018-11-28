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
 * Class AvInfo
 * 查看多媒体文件属性 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->avInfo('filename.mp3'); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class AvInfo extends AbstractPlugin {

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'avInfo';
    }

    public function handle($path = null)
    {
        return $this->filesystem->getAdapter()->avInfo($path);
    }
}
