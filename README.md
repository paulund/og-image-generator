# OG Image Generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/paulund/og-image-generator.svg?style=flat-square)](https://packagist.org/packages/paulund/og-image-generator)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/paulund/og-image-generator/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/paulund/og-image-generator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/paulund/og-image-generator/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/paulund/og-image-generator/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/paulund/og-image-generator.svg?style=flat-square)](https://packagist.org/packages/paulund/og-image-generator)

---
Laravel package to automatically create a og image that the page generates when it's saved to social media.
---

<!-- toc -->
- [Installation](#installation)
- [Configuration](#configuration)
- [Delete Old Images](#delete-old-images)
- [Testing](#testing)
- [Credits](#credits)
- [License](#license)
- [Tutorial](#tutorial)
<!-- tocstop -->

## Installation

You can install the package via composer:

```bash
composer require paulund/og-image-generator
npm install puppeteer
php artisan vendor:publish --provider="Paulund\OgImageGenerator\OgImageGeneratorServiceProvider"
```

In the `<head></head>` tag of your application you need to add the meta og-image tag. Pointing to the route
created by the package and passing in a variable of `$ogTitle` which is the text that will appear on the generated
image.

```
<meta property="og:image" content="{{ route('og-image', ['title' => $ogTitle ]) }}" />
```

## Configuration
There is no configuration required for this package. The package will automatically start generating Open Graph images for social media sharing.

But you can configure the package by publishing the config file, which will allow you to change the following configs.

- Image mime type - default is png
- Storage disk - default is local
- Storage path - default is public/og-images

## Delete Old Images

There is a command that you can run to delete all the old images that have been created by the package.

```bash
php artisan og-image:delete-old-images
```

This command will delete all the images that are older than 90 days.

This command is added to the Laravel scheduler to run every day.

## Testing
```bash
vendor/bin/testbench workbench:install
composer check
```

## Credits

- [paulund](https://paulund.co.uk)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Tutorial

To learn more about how this work you can read the tutorial on [Paulund](https://paulund.co.uk/auto-generate-open-graph-images-laravel)
