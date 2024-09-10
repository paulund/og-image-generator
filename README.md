# OG Image Generator

---
Laravel package to automatically create a og image that the page generates when it's saved to social media.
---

## Installation

You can install the package via composer:

```bash
composer require paulund/og-image-generator
```

In the `<head></head>` tag of your application you need to add the meta og-image tag. Pointing to the route
created by the package and passing in a variable of `$ogTitle` which is the text that will appear on the generated
image.

```
<meta property="og:image" content="{{ route('og-image', ['title' => $ogTitle ]) }}" />
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [paulund](https://github.com/paulund)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
