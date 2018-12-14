<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/10/17
 * Time: 下午23:29
 */

if (! function_exists('operationColor')) {
	function operationColor($method)
	{
		$array = \App\Models\OperationLog::$methodColors;
		return array_get($array, $method, 'grey');
	}
}


if (! function_exists('randomFloat')) {
    function randomFloat($min = 0, $max = 1) {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }
}

if (!function_exists('v4UUID')) {
    function v4UUID($namespace = '')
    {
        $guid = '';
        $uuid = uniqid('laravel_', true);
        $temp = $namespace ?? str_random();

        $temp .= $_SERVER['REQUEST_TIME'];
        $temp .= $_SERVER['HTTP_USER_AGENT'];
        $temp .= $_SERVER['LOCAL_ADDR'] ?? '127.0.0.1';
        $temp .= $_SERVER['LOCAL_PORT'] ?? '2556';
        $temp .= $_SERVER['REMOTE_ADDR'];
        $temp .= $_SERVER['REMOTE_PORT'];

        $hash_value = strtoupper(hash('ripemd160', $uuid . $guid . md5($temp)));

        return substr($hash_value,0,8) . '-' .
            substr($hash_value,8,4) . '-' .
            substr($hash_value,12,4) . '-' .
            substr($hash_value,16,4) . '-' .
            substr($hash_value,20,12);
    }
}

if (function_exists('filenameRandom')) {
    function filenameRandom($ext = ''): string
    {
        $key = hash('ripemd160', uniqid('laravel_', true).time());
        if (trim($ext)) {
            $key .= $ext;
        }
        return $key;
    }
}


if (! function_exists('buildPicUrl')) {
    /**
     * 转换图片url
     * @param null $url
     * @param string $style
     * @param bool $https
     * @return string
     */
    function buildPicUrl($url=null, $style='-pic640x320', $https=true)
    {
        if ($url === null) {
            return '/svg/default.png';
        }
        $domain = 'http://cdn.lnmpa.top/';

        if ($https === true) {
            $domain = 'https://cdn.lnmpa.top/';
        }
        if (! in_array($style, ['-pic640x320', '-pic240x120'])) {
            return $domain . $url;
        }

        return $domain . $url . $style;
    }
}

if (!function_exists('isActive')) {
    /**
     * Determine the nav if it is the current route.
     *
     * @param string $nav
     * @return boolean
     */
    function isActive($nav) {
        return Route::currentRouteName() == $nav ? 'active' : '';
    }
}

if (!function_exists('human_filesize')) {
    /**
     * Get a readable file size.
     *
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    function human_filesize($bytes, $decimals = 2) {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];

        $floor = floor((strlen($bytes)-1)/3);

        return sprintf("%.{$decimals}f", $bytes/pow(1024, $floor)).@$size[$floor];
    }
}

if (! function_exists('filterEmoji')) {
    function filterEmoji($string)
    {
        $str = preg_replace_callback(
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $string);

        return $str;
    }
}

if (! function_exists('zh_to_pinyin')) {
    function zh_to_pinyin(string $zhString)
    {
        $zhObj = new \App\Tools\ZhToPinyin\ZhToPinyin();

        return $zhObj->zh_to_pinyin($zhString);
    }
}


if (!function_exists('bd_translate')) {
    /**
     * 谨慎使用
     * ###通用翻译API每月提供200万字符免费额度，超出后需要按照当月全部使用字符数收费,任何一个标点、符号都算一个字符
     * ！！！超过200万字符，需按照49元人民币/百万字符支付当月全部翻译字符数费用（包括之前免费的200万字符）！！！
     * ###字符数（Byte）以翻译的源语言字符长度为标准计算，空格、html标签等均计入字符。###
     * ###一般来说，一个汉字占3个字符，一个英文字母占1个字符，一个半角标点符号占1个字符，一个全角标点符号占2个字符。###
     * ###例如：百度=6个字符，Baidu=5个字符。###
     * 可翻译长文本,通用翻译API支持28种语言互译，覆盖中、英、日、韩、西、法、泰、阿、俄、葡、德、意、荷、芬、丹等；支持28种语言的语种检测。
     * from 默认auto,可自动检测  more info=>http://api.fanyi.baidu.com/api/trans/product/apidoc
     * @param string $string
     * @param string $from
     * @param string $to
     * @return bool
     */
    function bd_translate(string $string, string $from = 'auto', string $to = 'en')
    {
        function buildSign($query, $appID, $salt, $secKey)
        {
            return md5($appID . $query . $salt . $secKey);
        }

        function call($url, $args=null, $method='post', $timeout = 10, $headers=array())
        {/*{{{*/
            $ret = false;
            $i = 0;
            while($ret === false)
            {
                if($i > 1)
                    break;
                if($i > 0)
                {
                    sleep(1);
                }
                $ret = callOnce($url, $args, $method, false, $timeout, $headers);
                $i++;
            }
            return $ret;
        }/*}}}*/

        function callOnce($url, $args=null, $method='post', $withCookie = false, $timeout = 10, $headers=array())
        {
            $ch = curl_init();
            if($method == 'post')
            {
                $data = convert($args);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_POST, 1);
            }
            else
            {
                $data = convert($args);
                if($data)
                {
                    if(stripos($url, "?") > 0)
                    {
                        $url .= "&$data";
                    }
                    else
                    {
                        $url .= "?$data";
                    }
                }
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            if(!empty($headers))
            {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }
            if($withCookie)
            {
                curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
            }
            $r = curl_exec($ch);
            curl_close($ch);
            return $r;
        }

        function convert(&$args)
        {
            $data = '';
            if (is_array($args))
            {
                foreach ($args as $key=>$val)
                {
                    if (is_array($val))
                    {
                        foreach ($val as $k=>$v)
                        {
                            $data .= $key.'['.$k.']='.rawurlencode($v).'&';
                        }
                    }
                    else
                    {
                        $data .="$key=".rawurlencode($val)."&";
                    }
                }
                return trim($data, "&");
            }
            return $args;
        }

        $app_id = config('my.bd_translate.app_id');
        $secret_key = config('my.bd_translate.secret_key');
        $url = config('my.bd_translate.url');

        if (! $app_id || ! $secret_key || ! $url) {
            return $string.'----error----';
        }

        $args = array(
            'q' => $string,
            'appid' => $app_id,
            'salt' => mt_rand(10000,99999),
            'from' => $from,
            'to' => $to,
            'sign' => ''
        );

        $args['sign'] = buildSign($string, $app_id, $args['salt'], $secret_key);

        $result = call($url, $args);

        $result = json_decode($result, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        if (isset($result['error_code'])) {
            // return ['message' => $result['error_msg']];
            return false;
        }

        if (isset($result['trans_result'][0]['dst'])) {
            return $result['trans_result'][0]['dst'];
        }

        return false;
    }
}
