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
 * Class ImagePreviewUrl
 * 图片预览地址，常常带有图片操作符，生成缩略图、水印等 <br>
 * $disk        = \Storage::disk('qiniu'); <br>
 * $re          = $disk->getDriver()->imagePreviewUrl('foo/bar1.css',$ops); <br>
 * @package App\Tools\Qiniu\Plugins
 */
class ImagePreviewUrl extends AbstractPlugin {

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'imagePreviewUrl';
    }

    /**
     * @param null $path
     * @param null $options  eg: imageView2/1/w/300/h/300/q/75|watermark/2/text/TE5NUEHpvpnokbU=/font/5a6L5L2T/fontsize/360/fill/I0M2QzhENg==/dissolve/100/gravity/SouthEast/dx/10/dy/10|imageslim
     * @return mixed
     * 这个options代表 300*300像素, 75%, 带水印,水印字体 等等信息
     */
    public function handle($path = null, $options = null)
    {
        return $this->filesystem->getAdapter()->imagePreviewUrl($path, $options);
    }
}
