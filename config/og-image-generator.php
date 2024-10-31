<?php

return [
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
     * CSS classes for the image
     */
    'styling' => [
        'background' => 'bg-gray-900',
        'text' => 'text-white',
    ],
];
