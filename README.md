# OG Image Generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/paulund/og-image-generator.svg?style=flat-square)](https://packagist.org/packages/paulund/og-image-generator)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/paulund/og-image-generator/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/paulund/og-image-generator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/paulund/og-image-generator/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/paulund/og-image-generator/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/paulund/og-image-generator.svg?style=flat-square)](https://packagist.org/packages/paulund/og-image-generator)

---
Laravel package to automatically create a og image that the page generates when it's saved to social media.
---

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

## Testing
```bash
vendor/bin/testbench workbench:install
composer check
```

## Credits

- [paulund](https://github.com/paulund)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
