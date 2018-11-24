<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/11/24
 * Time: 23:47
 */

namespace App\Http\Controllers\Api\V1;


class ErrorLogController extends ApiController
{
    public function index($file = null, Request $request)
    {
        if ($file === null) {
            $file = (new LogViewer())->getLastModifiedLog();
        }
        return Admin::content(function (Content $content) use ($file, $request) {
            $offset = $request->get('offset');
            $viewer = new LogViewer($file);
            $content->body(view('laravel-admin-logs::logs', [
                'logs'      => $viewer->fetch($offset),
                'logFiles'  => $viewer->getLogFiles(),
                'fileName'  => $viewer->file,
                'end'       => $viewer->getFilesize(),
                'tailPath'  => route('log-viewer-tail', ['file' => $viewer->file]),
                'prevUrl'   => $viewer->getPrevPageUrl(),
                'nextUrl'   => $viewer->getNextPageUrl(),
                'filePath'  => $viewer->getFilePath(),
                'size'      => static::bytesToHuman($viewer->getFilesize()),
            ]));
            $content->header($viewer->getFilePath());
        });
    }
    public function tail($file, Request $request)
    {
        $offset = $request->get('offset');
        $viewer = new LogViewer($file);
        list($pos, $logs) = $viewer->tail($offset);
        return compact('pos', 'logs');
    }
    protected static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2).' '.$units[$i];
    }
}
