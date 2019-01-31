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
    function buildPicUrl($url=null, $style='-pic640x320', $https=true)
    {
        if ($url === null) {
            return 'http://cdn2.lnmpa.top/issues/default.png';
        }
        $domain = 'http://cdn.lnmpa.top/';

        if ($https === true) {
            $domain = 'https://cdn.lnmpa.top/';
        }
        if (! in_array($style, ['-pic640x320', '-pic240x120', '-watermark'])) {
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
    function bd_translate($query, $from='auto', $to='en')
    {
        $bdObj = new \App\Tools\BaiduTranslate\BaiduTranslate();

        return $bdObj->translate_str($query, $from, $to);
    }
}
