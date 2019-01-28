<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/16
 * Time: 下午7:43
 */

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Storage;
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

        if (! $request->hasFile('file')) {
            return $this->response->withBadRequest('file not found');
        }

        // $path = $strategy . '/' . date('Y') . '/' . date('m') . '/' .date('d');
        $path = $strategy . '/' . date('Ymd');

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

    public function chunkUpload(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit','256M');

        $this->validate($request, [
            'file' => 'required'
        ]);

        $file = $request->file('file');
        $chunk = $request->post('chunk', 0);
        $chunks = $request->post('chunks', 0);

        $originalName = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

        $realPath = $file->getRealPath(); //临时目录
        $saved_name = '';

        if ($chunk == $chunks) {
            $saved_name = 'saved_' . date('Ymd-His') . ".$ext";

            $bool = Storage::disk('local')->put($saved_name, file_get_contents($realPath)); // 保存直接 app 目录下，分片的块在 temp 下

            if ($bool !== true) {
                return $this->response->withBadRequest('upload failed');
            }
            return $this->response->json([
                'original_name' => $originalName,
                'mime' => $file->getMimeType(),
                'size' => human_filesize($file->getClientSize()),
                'relative_url' => 'storage/' . $saved_name,
                'url' => asset('storage/' . $saved_name),
            ]);
        }
        else {
            // 分片的临时文件
            $filename = md5($originalName).'-'.($chunk+1).'.tmp';
            // $path_name = storage_path('app/temp/') . $filename;

            Storage::disk('temp')->put($filename, file_get_contents($realPath));

            if (($chunk + 1) == $chunks) {
                // 接收完所有分片，开始合成
                $saved_name = 'saved_'. date('Ymd-His') . ".$ext";
                $file_names = storage_path('app/') . $saved_name;// 保存直接 app 目录下，分片的块在 temp 下
                $fp = fopen($file_names,'ab');

                for($i=0; $i<$chunks; $i++){
                    $tmp_files = storage_path('app/temp/') . md5($originalName).'-'.($i+1).'.tmp';
                    $handle = fopen($tmp_files,'rb');
                    fwrite($fp, fread($handle, filesize($tmp_files)));
                    fclose($handle);
                    unlink($tmp_files);
                }
                //关闭句柄
                fclose($fp);
            }

            return $this->response->json([
                'original_name' => $originalName,
//                'mime' => $file->getMimeType(),
//                'size' => human_filesize($file->getClientSize()),
                'relative_url' => 'storage/' . $saved_name,
                'url' => asset('storage/' . $saved_name),
            ]);
        }
    }
}
