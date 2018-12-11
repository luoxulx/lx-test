<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/4
 * Time: 下午2:21
 */

namespace App\Http\Controllers\Api\V1;

use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;

class MailController extends ApiController
{

    protected $auth;

    public function __construct()
    {
        parent::__construct();
        $this->auth = '';
    }

    public function sendMail()
    {
        $res = Mail::to('luoxulx@aliyun.com')->send(new ResetPassword(['title'=>'The Title', 'content'=>'the content']));var_dump($res);
        // return $this->response->withNoContent();
    }

    public function show()
    {
        return (new ResetPassword(['title'=>'The Title', 'content'=>'the content']))->render();
    }
}
