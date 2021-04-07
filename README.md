------

## ⚗️ About OcStan

- Adds static typing to Laravel to improve developer productivity and **code quality**
- Supports most of [Laravel](https://laravel.com)'s **beautiful magic**
- Supports most of [OctoberCMS](https://octobercms.com)'s **beautiful magic**
- Discovers bugs in your code without running it

## ✨ Getting Started In 3 Steps

> **Requires:**
- **[PHP 7.2+](https://php.net/releases/)**
- **[Laravel 6.0+](https://github.com/laravel/laravel)**

**1**: First, you may use [Composer](https://getcomposer.org) to install Larastan as a development dependency into your Laravel project:
```bash
composer require --dev lemax10/ocstan
```

> Using Larastan for analysing Laravel packages? You may need to install `orchestra/testbench`.

**2**: Then, create a `phpstan.neon` or `phpstan.neon.dist` file in the root of your application. It might look like this:

```
includes:
    - ./vendor/lemax10/ocstan/extension.neon

parameters:

    paths:
        - app

    # The level 8 is the highest level
    level: 4

    ignoreErrors:
        - '#Unsafe usage of new static#'

    excludePaths:
        - ./*/*/FileToBeExcluded.php

    checkMissingIterableValueType: false
```

For all available options, please take a look at the PHPStan documentation: **https://phpstan.org/config-reference**

**3**: Finally, you may start analyzing your code using the phpstan console command:

```bash
./vendor/bin/phpstan analyse
```

If you are getting the error `Allowed memory size exhausted`, then you can use the `--memory-limit` option fix the problem:

```bash
./vendor/bin/phpstan analyse --memory-limit=2G
```

## Rules

A list of configurable rules specific to Laravel can be found [here](docs/rules.md).

## Custom PHPDoc types

A list of PHPDoc types specific to Larastan can be found [here](docs/custom-types.md).

## Custom PHPStan config parameters
A list of custom config parameters that you can use in your PHPStan config file can be found [here](docs/custom-config-paramaters.md).

## Errors To Ignore

Some parts of Laravel are currently too magical for Larastan/PHPStan to understand.
We listed common [errors to ignore](docs/errors-to-ignore.md), add them as needed.

## 👊🏻 Contributing

Thank you for considering contributing to Larastan. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

You can have a look at the [CHANGELOG](CHANGELOG.md) for constant updates & detailed information about the changes. You can also follow the Twitter account for the latest announcements or just come say hi!: [@enunomaduro](https://twitter.com/enunomaduro), [@can__vural](https://twitter.com/can__vural).

## ❤️ Support The Development

**Do you like this project? Support it by donating**

- PayPal: [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=66BYDWAT92N6L)
- Patreon: [Donate](https://www.patreon.com/nunomaduro)

## 📖 License

OCStan is an open-sourced software licensed under the [MIT license](LICENSE.md).
Larastan is an open-sourced software licensed under the [MIT license](LICENSE.md).
