<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/27
 * Time: 23:06
 */

namespace App\Http\Controllers\Api\V1;

use App\Tools\Qiniu\QiniuTool;
use Illuminate\Http\Request;


class ImageController extends ApiController
{

    private $disk;

    public function __construct()
    {
        parent::__construct();

        $this->disk = new QiniuTool();
    }

    public function index(Request $request)
    {
        $path = $request->post('prefix') ?? ''; // 目录带 /
        $limit = $request->post('limit', 500);
        $list = $this->disk->files($path, $limit);

        return $this->response->json($list);
    }

    public function upload_token()
    {
        return $this->response->json([
            'qiniu_token' => $this->disk->uploadToken(),
            'qiniu_key' => $this->disk->filenameRandom()
        ]);
    }

    public function store(Request $request)
    {
        $path = 'test_file/'; // 目录带 /
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();

        if (! $request->file('image')) {
            return $this->response->withBadRequest('Bad Request with null image');
        }

        $response = $this->disk->putFile($path, $image, $ext);

        return $this->response->json($response);
    }

    public function delete(Request $request)
    {
        $filename = $request->post('filename');

        if (!$filename) {
            return $this->response->withBadRequest('Bad Request with null filename');
        }

        $res = $this->disk->deleteOriginFile($filename);

        if ($res === null) {
            return $this->response->withNoContent();
        }
        return $this->response->withBadRequest('Bad Request with no such file or directory');
    }

}
