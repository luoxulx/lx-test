<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/23
 * Time: 13:42
 */

namespace App\Http\Controllers\Api\V1;

use App\Tools\QiniuFileManager;

class ToolController extends ApiController
{

    /**
     * @param QiniuFileManager $qiniuFileManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function qiniuToken(QiniuFileManager $qiniuFileManager)
    {
        return $this->response->json(['token'=>$qiniuFileManager->uploadToken()]);
    }
}
