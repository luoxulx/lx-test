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
 * Class verifyCallback
 * 验证回调是否正确 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->verifyCallback('application/x-www-form-urlencoded', $request->header('Authorization'), 'callback url', $request->getContent()); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class VerifyCallback extends AbstractPlugin
{

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'verifyCallback';
    }

    public function handle($contentType = null, $originAuthorization = null, $url = null, $body = null)
    {
        return $this->filesystem->getAdapter()->verifyCallback($contentType, $originAuthorization, $url, $body);
    }
}
