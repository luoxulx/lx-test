<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/4
 * Time: 下午2:21
 */

namespace App\Http\Controllers\Api\V1;

use App\Mail\NewComment;
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
        Mail::to('luoxulx@aliyun.com')->send(new NewComment());
        return $this->response->withNoContent();
    }

    public function show()
    {
        return (new NewComment())->render();
    }
}
