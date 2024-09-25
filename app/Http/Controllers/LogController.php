<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function showLogs()
    {
        $logFiles = File::files(storage_path('logs'));

        $logFileNames = array_map('basename', $logFiles);

        return view('content.logs.logs', ['logFileNames' => array_reverse($logFileNames)]);
    }

    public function showLogFile($fileName)
    {
        $logFilePath = storage_path("logs/{$fileName}");

        if (File::exists($logFilePath)) {
            $logContent = File::get($logFilePath);

            return view('content.logs.log_details', ['logContent' => $logContent]);
        } else {
            return redirect('/logs?status=empty');
        }
    }
}
