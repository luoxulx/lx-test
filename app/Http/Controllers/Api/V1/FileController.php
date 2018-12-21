<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/16
 * Time: 下午7:43
 */

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;

class FileController extends ApiController
{

    protected $manager;

    public function __construct()
    {
        parent::__construct();

        $this->manager = app('file_manage');
    }

    public function fileIndex(Request $request)
    {
        $data = $this->manager->folderInfo($request->get('folder'));

        return $this->response->json([ 'data' => $data ]);
    }

    /**
     * Generic file upload method.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fileUpload(Request $request)
    {
        $strategy = $request->get('path', 'temp'); //不带 /

        if (!$request->hasFile('file')) {
            return $this->response->json(['data' => [
                'success' => false,
                'error' => 'no file found.'
            ]]);
        }

        $path = $strategy . '/' . date('Y') . '/' . date('m');

        $result = $this->manager->store($request->file('file'), $path);

        return $this->response->json(['data'=>$result]);
    }

    /**
     * Delete the file.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile(Request $request)
    {
        $path = $request->get('path');

        $data = $this->manager->deleteFile($path);

        return $this->response->json([ 'data' => $data ]);
    }

    /**
     * Create the folder.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createFolder(Request $request)
    {
        $folder = $request->get('path');

        $data = $this->manager->createFolder($folder);

        return $this->response->json([ 'data' => $data ]);
    }

    /**
     * Delete the folder.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');

        $folder = $request->get('path') . '/' . $del_folder;

        $data = $this->manager->deleteFolder($folder);

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
    public function uploadForManager(Request $request)
    {
        $file = $request->file('file');

        $fileName = $request->get('name')
            ? $request->get('name').'.'.explode('/', $file->getClientMimeType())[1]
            : $file->getClientOriginalName();

        $path = str_finish($request->get('path'), '/');

        if ($this->manager->checkFile($path.$fileName)) {
            return $this->response->withBadRequest('This File exists.');
        }

        $result = $this->manager->store($file, $path, $fileName);

        return $this->response->json(['data'=>$result]);
    }
}
