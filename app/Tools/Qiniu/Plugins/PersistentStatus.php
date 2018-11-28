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
 * Class PersistentStatus
 * 查询持久化操作状态 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->persistentStatus('foo/bar1.css'); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class PersistentStatus extends AbstractPlugin {

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'persistentStatus';
    }

    public function handle($id)
    {
        return $this->filesystem->getAdapter()->persistentStatus($id);
    }
}
