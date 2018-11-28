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
 * Class Fetch
 * 调用qiniu的fetch指令 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->fetch('http://abc.com/foo.jpg', 'bar.jpg'); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class Fetch extends AbstractPlugin
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'fetch';
    }

    public function handle($url, $key)
    {
        return $this->filesystem->getAdapter()->fetch($url, $key);
    }
}
