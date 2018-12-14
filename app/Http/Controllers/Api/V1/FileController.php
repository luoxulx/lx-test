<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/15
 * Time: 下午22:16
 */

namespace App\Http\Controllers\Api\V1;


use App\Tools\Qiniu\QiniuTool;
use Illuminate\Http\Request;

class FileController extends ApiController
{

    protected $qiniuDisk;
    protected $localDisk;

    public function __construct()
    {
        parent::__construct();

        $this->qiniuDisk = new QiniuTool();
    }

    #local --------- start

    public function localUpload()
    {
        return 1;
    }
    # local --------- end

    # qiniu --------- start

    public function qiniuToken()
    {
        return $this->response->json([
            'qiniu_token' => $this->qiniuDisk->uploadToken(),
            'qiniu_key' => md5(uniqid('14k', true).time())
        ]);
    }

    public function qiniuUpload(Request $request)
    {
        $path = $request->post('path','test_file/'); // 目录带 /
        $image = $request->file('file');
        if (! $request->file('file')) {
            return $this->response->withBadRequest('Bad Request with null file');
        }
        $ext = $image->getClientOriginalExtension();

        $response = $this->qiniuDisk->putFile($path, $image, $ext);

        return $this->response->json($response);
    }

    public function qiniuList(Request $request)
    {
        $path = $request->post('prefix') ?? ''; // 目录带 /
        $limit = $request->post('limit', 500);
        $list = $this->qiniuDisk->files($path, $limit);

        return $this->response->json(['data'=>$list, 'total'=>\count($list)]);
    }

    public function qiniuDelOne(Request $request)
    {
        $filename = $request->post('filename');

        if (!$filename) {
            return $this->response->withBadRequest('Bad Request with null filename');
        }

        $res = $this->qiniuDisk->deleteOriginFile($filename);

        if ($res === null) {
            return $this->response->withNoContent();
        }
        return $this->response->withBadRequest('Bad Request with no such file or directory');
    }

    public function qiniuDir()
    {
        return $this->response->json(['data'=>$this->qiniuDisk->allDir()]);
    }
    # qiniu --------- end
}
