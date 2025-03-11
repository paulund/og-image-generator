<?php

namespace Paulund\OgImageGenerator\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Paulund\OgImageGenerator\Actions\HtmlToPng;

class OgImageController extends Controller
{
    private bool $showBlade = false;

    private array $styling;

    private array $extra;

    private string $view;

    private string $disk;

    public function __construct()
    {
        $this->styling = \config('og-image-generator.styling');
        $this->extra = \config('og-image-generator.extra');
        $this->view = \config('og-image-generator.view');
        $this->disk = \config('og-image-generator.storage.disk');
    }

    public function __invoke(Request $request): \Illuminate\Http\Response
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        if ($request->has('showBlade')) {
            $this->showBlade = true;
        }

        $slugTitle = Str::slug($request->get('title', 'Title'));

        if ($this->showBlade === false && $this->hasImage($slugTitle)) {
            return $this->returnImage($this->getImage($slugTitle));
        }

        $data = [
            'title' => request('title', 'Title'),
            'styling' => $this->styling,
        ];

        foreach ($this->extra as $parameter) {
            $data[$parameter] = request($parameter);
        }

        $html = view($this->view, $data)->render();

        if ($this->showBlade) {
            return response($html);
        }

        $image = app(HtmlToPng::class)->execute($html);

        $this->saveImage($slugTitle, $image);

        return $this->returnImage($image);
    }

    private function returnImage(string $image): \Illuminate\Http\Response
    {
        return response($image, 200, [
            'Content-Type' => 'image/'.config('og-image-generator.image.mime'),
        ]);
    }

    private function getFilePath(string $slugTitle): string
    {
        $folder = config('og-image-generator.storage.path');
        $mimeType = config('og-image-generator.image.mime');

        return $folder.'/'.$slugTitle.'.'.$mimeType;
    }

    private function hasImage(string $slugTitle): bool
    {
        return Storage::disk($this->disk)->exists($this->getFilePath($slugTitle));
    }

    private function getImage(string $slugTitle): string
    {
        return Storage::disk($this->disk)->get($this->getFilePath($slugTitle));
    }

    private function saveImage(string $slugTitle, string $image): void
    {
        Storage::disk($this->disk)->put($this->getFilePath($slugTitle), $image);
    }
}
