<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

it('deletes images older than 90 days', function () {
    Storage::fake('local');

    $path = config('og-image-generator.storage.path');
    $oldFile = $path.'/old_image.png';
    $newFile = $path.'/new_image.png';

    Storage::disk('local')->put($oldFile, 'content');
    touch(Storage::disk('local')->path($oldFile), Carbon::now()->subDays(91)->timestamp);
    Storage::disk('local')->put($newFile, 'content');
    touch(Storage::disk('local')->path($newFile), Carbon::now()->subDays(1)->timestamp);

    $this->artisan('og-image:delete-old-images')->assertExitCode(0);

    Storage::disk('local')->assertMissing($oldFile);
    Storage::disk('local')->assertExists($newFile);
});

it('does not delete images newer than 90 days', function () {
    Storage::fake('local');

    $path = config('og-image-generator.storage.path');
    $newFile = $path.'/new_image.png';

    Storage::disk('local')->put($newFile, 'content');

    Carbon::setTestNow(Carbon::now()->subDays(1));
    touch(Storage::disk('local')->path($newFile));
    Carbon::setTestNow();

    $this->artisan('og-image:delete-old-images')->assertExitCode(0);

    Storage::disk('local')->assertExists($newFile);
});

it('handles empty storage path gracefully', function () {
    Storage::fake('local');

    $this->artisan('og-image:delete-old-images')->assertExitCode(0);

    $this->assertTrue(true); // Ensure no exceptions are thrown
});
