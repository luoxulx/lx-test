<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/27
 * Time: 23:06
 */

namespace App\Http\Controllers\Api\V1;

use Qiniu\Auth;
use Illuminate\Http\Request;


class ImageController extends ApiController
{

    protected $accessKey;
    protected $secretKey;
    protected $bucketName;
    protected $fileService;
    protected $auth;

    public function __construct()
    {
        parent::__construct();
        $this->accessKey = config('my.QNConfig.ak');
        $this->secretKey = config('my.QNConfig.sk');
        $this->bucketName = config('my.QNConfig.bucket');

        $this->auth = new Auth($this->accessKey, $this->secretKey);
    }

    public function store(Request $request)
    {
        $uploadedFile = $request->file('image_file');
        $path = $uploadedFile->store('images');
        $path = storage_path() . "/app/$path";
        $image_name = $request->input('image_name');
        $image_for = $request->input('image_for');

        try {
            $response = $this->auth;
        } catch (Exception $exception) {

        }
    }
}
