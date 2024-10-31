<?php

namespace Paulund\OgImageGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Storage;

class DeleteOldImages extends Command
{
    protected $signature = 'og-image:delete-old-images';

    protected $description = 'Delete old images from the storage folder';

    public function __construct(
        #[Config('og-image-generator.storage.disk')] private readonly ?string $disk,
        #[Config('og-image-generator.storage.path')] private readonly ?string $path,
        #[Config('og-image-generator.storage.lifetime', 90)] private readonly int $lifetime,
    ) {
        parent::__construct();
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
