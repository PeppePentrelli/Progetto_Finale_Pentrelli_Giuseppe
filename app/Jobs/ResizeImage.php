<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Spatie\Image\Enums\Unit;
use Spatie\Image\Enums\CropPosition;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResizeImage implements ShouldQueue
{
    use Queueable;

    private $w, $h, $fileName, $path, $mode, $cropPosition;

    /**
     * @param string 
     * @param int 
     * @param int 
     * @param string 
     * @param CropPosition|null 
     */

    public function __construct($filePath, $w, $h, $mode = 'crop', $cropPosition = null)
    {
        $this->path = dirname($filePath);
        $this->fileName = basename($filePath);
        $this->w = $w;
        $this->h = $h;
        $this->mode = $mode;
        $this->cropPosition = $cropPosition ?? CropPosition::Center;
    }

    public function handle(): void
    {
        $srcPath = storage_path("app/public/{$this->path}/{$this->fileName}");
        $destPath = storage_path("app/public/{$this->path}/resized_{$this->mode}_{$this->w}x{$this->h}_{$this->fileName}");

        $image = Image::load($srcPath);

        switch ($this->mode) {
            case 'crop':
                $image->crop($this->w, $this->h, $this->cropPosition);
                break;

            case 'resize':
                $image->resize($this->w, $this->h);
                break;

            case 'fit':

                $image->resize($this->w, $this->h)
                    ->background('ffffff')
                    ->save($destPath);
                return;
        }

        $image->watermark(
            base_path('resources/img/watermark.png'),
            width: 50,
            height: 50,
            paddingX: 5,
            paddingY: 5,
            paddingUnit: Unit::Percent
        )->save($destPath);
    }
}
