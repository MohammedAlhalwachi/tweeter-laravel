<?php

namespace App\Http\Middleware;

use Closure;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class OptimizeImages
{
    public function handle($request, Closure $next)
    {
        collect($request->allFiles())
            ->flatten()
            ->filter(function (UploadedFile $file) {
                if (app()->environment('testing')) {
                    return true;
                }

                return $file->isValid();
            })
            ->each(function (UploadedFile $file) {
                $img = Image::make($file)->widen(1000);
                $img->save($file->getPathname(), 80, $file->getClientOriginalExtension());
            });

        return $next($request);
    }
}
