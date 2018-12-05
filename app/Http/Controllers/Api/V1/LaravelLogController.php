<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/24
 * Time: 23:47
 */

namespace App\Http\Controllers\Api\V1;

use App\Tools\LaravelLogTool\LaravelLogView;
use Illuminate\Http\Request;

class LaravelLogController extends ApiController
{

    public function index(Request $request)
    {
        $offset = $request->get('offset');
        $logViewObj = new LaravelLogView();

        return $this->response->json([
            'data' => [
                'logs' => $logViewObj->fetch(2),
                'log_files' => $logViewObj->getLogFiles(10),
                'file_name' => $logViewObj->file,
                'end' => $logViewObj->getFilesize(),
                'tail_path' => 'aa',
                'file_path' => $logViewObj->getFilePath(),
                'size'      => $logViewObj::bytesToHuman($logViewObj->getFilesize()),
            ]
        ]);
    }
}
