<?php

use Paulund\OgImageGenerator\Actions\HtmlToPng;

beforeEach(function () {
    \Illuminate\Support\Facades\Storage::fake('local');
});

test('the og image route returns successful', function () {
    $htmlToPngMock = Mockery::mock(HtmlToPng::class);
    $htmlToPngMock->shouldReceive('execute')->andReturn('image');
    $this->swap(HtmlToPng::class, $htmlToPngMock);

    $response = $this->get('/og-image?title=Hello World');
    $response->assertStatus(200);
    \Illuminate\Support\Facades\Storage::disk('local')->assertExists('public/og-images/hello-world.png');
});

test('it shows validation error if title is not in request', function () {
    /** @var \Illuminate\Testing\TestResponse $response */
    $response = $this->get('/og-image');
    $response->assertStatus(302);
});
