<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $path = storage_path('app/private/test.mp4');

    if (! file_exists($path)) {
        abort(404);
    }

    return response()->stream(function () use ($path) {
        $stream = fopen($path, 'rb');
        fpassthru($stream);
        fclose($stream);
    }, 200, [
        'Content-Type' => mime_content_type($path),
        'Content-Length' => filesize($path),
        'Content-Disposition' => 'inline; filename="'.basename($path).'"',
    ]);
});

Route::get('/test2', function (Request $request) {
    $path = storage_path('app/private/test.mp4');

    if (! file_exists($path)) {
        abort(404);
    }

    $size = filesize($path);
    $start = 0;
    $end = $size - 1;

    $headers = [
        'Content-Type' => mime_content_type($path),
        'Accept-Ranges' => 'bytes',
        'Content-Disposition' => 'inline; filename="'.basename($path).'"',
    ];

    // Tangani permintaan Range dari browser/video player
    if ($request->headers->has('Range')) {
        $range = $request->header('Range'); // contoh: "bytes=1000-2000"
        if (preg_match('/bytes=(\d+)-(\d*)/', $range, $matches)) {
            $start = intval($matches[1]);
            if (isset($matches[2]) && $matches[2] !== '') {
                $end = intval($matches[2]);
            }
        }

        // Pastikan valid
        if ($start > $end || $end >= $size) {
            return response('Invalid Range', 416)->header('Content-Range', "bytes */$size");
        }

        $length = $end - $start + 1;
        $headers['Content-Length'] = $length;
        $headers['Content-Range'] = "bytes $start-$end/$size";

        return response()->stream(function () use ($path, $start, $length) {
            $handle = fopen($path, 'rb');
            fseek($handle, $start);
            echo fread($handle, $length);
            fclose($handle);
        }, 206, $headers); // 206 Partial Content
    }

    // Kalau tidak ada Range, kirim semua
    $headers['Content-Length'] = $size;

    return response()->stream(function () use ($path) {
        readfile($path);
    }, 200, $headers);
});
