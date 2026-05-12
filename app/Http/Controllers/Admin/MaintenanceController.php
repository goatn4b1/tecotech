<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class MaintenanceController extends Controller
{
    public function clearCache(): RedirectResponse
    {
        Artisan::call('optimize:clear');

        return back()->with('success', 'Đã xóa cache Laravel thành công.');
    }

    public function buildAssets(): RedirectResponse
    {
        $command = PHP_OS_FAMILY === 'Windows'
            ? ['npm.cmd', 'run', 'build']
            : ['npm', 'run', 'build'];

        $process = new Process($command, base_path());
        $process->setTimeout(180);
        $process->run();

        if (! $process->isSuccessful()) {
            $output = trim($process->getErrorOutput() ?: $process->getOutput());

            return back()->with('error', 'Build thất bại: '.str($output)->limit(500));
        }

        return back()->with('success', 'Đã build lại assets thành công.');
    }
}
