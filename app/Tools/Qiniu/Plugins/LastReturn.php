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
 * Class LastReturn
 * 得到最后一次上传文件的 返回值 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->lastReturn(); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class LastReturn extends AbstractPlugin
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'lastReturn';
    }

    public function handle($path = null)
    {
        return $this->filesystem->getAdapter()->getLastReturn();
    }
}
