# Laravel Classes and Migrations generator

This package was created using the [Nette php-generator](https://github.com/nette/php-generator).

[![Latest Version on Packagist](https://img.shields.io/packagist/v/onza-me/domda_backend_auth_models.svg?style=flat-square)](https://packagist.org/packages/onza-me/domda_backend_auth_models)
[![Build Status](https://img.shields.io/travis/onza-me/domda_backend_auth_models/master.svg?style=flat-square)](https://travis-ci.org/onza-me/domda_backend_auth_models)
[![Quality Score](https://img.shields.io/scrutinizer/g/onza-me/domda_backend_auth_models.svg?style=flat-square)](https://scrutinizer-ci.com/g/onza-me/domda_backend_auth_models)
[![Total Downloads](https://img.shields.io/packagist/dt/onza-me/domda_backend_auth_models.svg?style=flat-square)](https://packagist.org/packages/onza-me/domda_backend_auth_models)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require xamel03rus/laravel_generator
```

## Usage

```injectablephp
$classes = [
    [
        "name" => 'SimpleModel',
        'fields' => [
            [
                'name' => 'id',
                'type' => 'integer',
                'props' => []
            ],
            [
                'name' => 'name',
                'type' => 'string',
                'props' => []
            ]
        ],
        'properties' => [
            'table' => 'simple_models',
            'guarded' => ['id'],
            'fillable' => [],
        ],
        "relations" => [
            [
                'name' => 'users',
                'type' => 'belongsTo',
                'class' => 'HardModel'
            ]
        ]
    ]
];

app('laravel_generator_service')->processData($classes);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email moais611@gmail.com instead of using the issue tracker.

## Credits

- [Xamel](https://github.com/onza-me)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.