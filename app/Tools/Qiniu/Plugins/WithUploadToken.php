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
 * Class WithUploadToken
 * 下次 put 操作，将使用该 uploadToken 进行上传。 常用于持久化操作。 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->withUploadToken($token); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class WithUploadToken extends AbstractPlugin
{

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'withUploadToken';
    }

    public function handle($token)
    {
        $this->filesystem->getAdapter()->withUploadToken($token);
    }
}
