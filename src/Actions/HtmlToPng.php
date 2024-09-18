<?php

namespace Paulund\OgImageGenerator\Actions;

use Spatie\Browsershot\Browsershot;

class HtmlToPng
{
    public function execute($html)
    {
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

        return $browsershot->screenshot();
    }
}
