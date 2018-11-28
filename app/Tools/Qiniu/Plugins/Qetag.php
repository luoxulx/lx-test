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
 * Class Qetag
 * 得到最后一次上传文件的 Qetag <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->qetag(); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class Qetag extends AbstractPlugin
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'qetag';
    }

    public function handle($path = null)
    {
        return $this->filesystem->getAdapter()->getLastQetag();
    }
}
