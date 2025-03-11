<?php

return [
    /**
     * Extra request parameters to pass to the view
     */
    'extra' => [],

    /**
     * The image mime type
     */
    'image' => [
        'mime' => 'png',
    ],

    /**
     * Where are the images stored
     */
    'storage' => [
        'disk' => 'local',
        'path' => 'public/og-images',
        'lifetime' => 90,
    ],

    /**
     * The view to use for the image
     */
    'view' => env('OG_IMAGE_GENERATOR_VIEW', 'paulund/og-image-generator::image'),

    /**
     * CSS classes for the image
     */
    'styling' => [
        'background' => 'bg-gray-900',
        'text' => 'text-white',
    ],
];
