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


if (! function_exists('buildPicUrl')) {
    /**
     * 转换图片url
     * @param null $url
     * @param string $style
     * @param bool $https
     * @return string
     */
    function buildPicUrl($url=null, $style='-pic640x320', $https=false)
    {
        if ($url === null) {
            return '/svg/default.png';
        }
        if (! in_array($style, ['-pic640x320', '-pic240x120'])) {
            return 'error';
        }
        $domain = 'http://cdn.lnmpa.top/';

        if ($https) {
            $domain = 'https://cdn.lnmpa.top/';
        }
        return $domain . $url . $style;
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
