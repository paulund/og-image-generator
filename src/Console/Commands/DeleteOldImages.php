<?php

namespace Paulund\OgImageGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteOldImages extends Command
{
    protected $signature = 'og-image:delete-old-images';

    protected $description = 'Delete old images from the storage folder';

    private ?string $disk;

    private ?string $path;

    private int $lifetime;

    public function __construct()
    {
        parent::__construct();
        $this->disk = config('og-image-generator.storage.disk');
        $this->path = config('og-image-generator.storage.path');
        $this->lifetime = config('og-image-generator.storage.lifetime', 90);
    }

    public function handle(): void
    {
        $this->info('Deleting old images...');

        $files = Storage::disk($this->disk)->files($this->path);

        $now = now();
        foreach ($files as $file) {
            $lastModified = Storage::disk($this->disk)->lastModified($file);
            $fileDate = \Carbon\Carbon::createFromTimestamp($lastModified);

            if (abs($now->diffInDays($fileDate)) > $this->lifetime) {
                Storage::disk($this->disk)->delete($file);
                $this->info("Deleted: $file");
            }
        }

        $this->info('Old images deleted.');
    }
}
