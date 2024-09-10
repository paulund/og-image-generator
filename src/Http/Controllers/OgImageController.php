<?php

namespace Paulund\OgImageGenerator\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;

class OgImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $slugTitle = Str::slug(request('title', 'Title'));

        if ($this->hasImage($slugTitle)) {
            return response($this->getImage($slugTitle), 200, [
                'Content-Type' => 'image/png',
            ]);
        }

        $html = view('paulund/og-image-generator::image', [
            'title' => request('title', 'Title'),
        ])->render();

        $browsershot = Browsershot::html($html)
            ->noSandbox()
            ->showBackground()
            ->windowSize(1200, 630)
            ->setScreenshotType('png');

        if (config('chrome.node_path')) {
            $browsershot->setNodeBinary(config('chrome.node_path'));
        }

        if (config('chrome.npm_path')) {
            $browsershot->setNpmBinary(config('chrome.npm_path'));
        }

        $image = $browsershot->screenshot();

        $this->saveImage($slugTitle, $image);

        return response($image, 200, [
            'Content-Type' => 'image/png',
        ]);
    }

    private function getFilePath($slugTitle)
    {
        return 'public/og-images/'.$slugTitle.'.png';
    }

    private function hasImage($slugTitle)
    {
        return Storage::disk('local')->exists($this->getFilePath($slugTitle));
    }

    private function getImage($slugTitle)
    {
        return Storage::disk('local')->get($this->getFilePath($slugTitle));
    }

    private function saveImage($slugTitle, $image)
    {
        Storage::disk('local')->put($this->getFilePath($slugTitle), $image);
    }
}
