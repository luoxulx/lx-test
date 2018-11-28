<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/27
 * Time: 23:06
 */

namespace App\Http\Controllers\Api\V1;

use App\Tools\Qiniu\QiniuStorage;
use Illuminate\Http\Request;


class ImageController extends ApiController
{

    public function store(Request $request)
    {
        $prefix = $request->post('prefix', '/');
        if (! $request->file('file')) {
            return $this->response->json(['message'=>'NULL file']);
        }
        $disk = QiniuStorage::disk('qiniu');
        $response = $disk->put($prefix, $request->file('file'));var_dump($response);

        $imagePreviewUrl = $disk->imagePreviewUrl($response);
        var_dump($imagePreviewUrl);die;

    }

    public function index(Request $request)
    {
        $prefix = $request->post('prefix', '/');

        $disk = QiniuStorage::disk('qiniu');

        $response = $disk->files($prefix);

        return $this->response->json(['files'=>$response]);
    }
}
