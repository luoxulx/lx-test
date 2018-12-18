<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/15
 * Time: 下午22:16
 */

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Tools\Qiniu\QiniuTool;
use App\Tools\FileManage\BaseFileManage;

class FileController extends ApiController
{

    protected $qiniuDisk;
    protected $localDisk;

    public function __construct()
    {
        parent::__construct();

        $this->qiniuDisk = new QiniuTool();
        $this->localDisk = new BaseFileManage();
    }

    #local --------- start

    public function localIndex(Request $request)
    {
        $data = $this->localDisk->folderInfo($request->get('prefix'));

        return $this->response->json([ 'data' => $data ]);

    }

    public function localUpload(Request $request)
    {
        $prefix = $request->get('prefix', 'test_file/'); //必须带 /

        if (!$request->hasFile('file')) {
            return $this->response->json([
                'success' => false,
                'error' => 'no file found.',
            ]);
        }

        $path = $prefix . date('Y') . '/' . date('m');

        $result = $this->localDisk->store($request->file('file'), $path);

        return $this->response->json($result);
    }

    /**
     * Create the folder.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function localCreateFolder(Request $request)
    {
        $folder = $request->get('folder');

        $data = $this->localDisk->createFolder($folder);

        return $this->response->json([ 'data' => $data ]);
    }

    /**
     * Delete the file.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function localDelFile(Request $request)
    {
        $path = $request->get('path');

        $data = $this->localDisk->deleteFile($path);

        return $this->response->json([ 'data' => $data ]);
    }



    /**
     * Delete the folder.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function localDelFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');

        $folder = $request->get('folder') . '/' . $del_folder;

        $data = $this->localDisk->deleteFolder($folder);

        if(!$data) {
            return $this->response->withForbidden('The directory must be empty to delete it.');
        }

        return $this->response->json([ 'data' => $data ]);
    }



    /**
     * Upload the file for file manager.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function localUploadForManager(Request $request)
    {
        $file = $request->file('file');

        $fileName = $request->get('name')
            ? $request->get('name').'.'.explode('/', $file->getClientMimeType())[1]
            : $file->getClientOriginalName();

        $path = str_finish($request->get('folder'), '/');

        if ($this->localDisk->checkFile($path.$fileName)) {
            return $this->response->withBadRequest('This File exists.');
        }

        $result = $this->localDisk->store($file, $path, $fileName);

        return $this->response->json($result);

    }
    # local --------- end

    # qiniu --------- start

    public function qiniuToken()
    {
        return $this->response->json([
            'qiniu_token' => $this->qiniuDisk->uploadToken(),
            'qiniu_key' => md5(uniqid('14k.Frankenstein', true).time())
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
