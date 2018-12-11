<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/4
 * Time: 下午2:21
 */

namespace App\Http\Controllers\Api\V1;

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

    }

    public function show()
    {

    }
}
