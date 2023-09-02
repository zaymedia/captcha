# Captcha

Is an easy to install self-hosted image captcha library. Through a predefined dictionary, the library generates images that must be selected in a specific order.

This captcha solution may not be 100% secure against bots, but in combination with other popular captcha services, it will be an extra layer of security for your platform.

![example](https://user-images.githubusercontent.com/35383529/220480833-dcd2b516-9b85-4944-8464-6a6f8d92fdb2.jpg)

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Cache Adapters](#cache-adapters)
- [Generate Links](#generate-links)
- [Validate Answer](#validate-answer)
- [Flush Links](#flush-links)
- [Customize Options](#customize-options)
- [License](#license)

## Installation

You can install the package via composer:

```sh
composer require zaymedia/captcha
```

## Usage

To get started with the package, you must use the `make()` static method and pass as first parameter an identifier string. This identifier parameter will be used to store & get the generated challenge and solution.

```php
Use ZayMedia\Captcha\Captcha;
use ZayMedia\Captcha\CacheAdapters\SimpleFileCacheAdapter;

$captcha = Captcha::make('1', new SimpleFileCacheAdapter(__DIR__ . '/cache'));

var_dump($captcha->generateLinks());
```

> Generally you should use the user id, ip address, or a generated cookie.

## Cache Adapters

In order to use the Captcha class, you will need to choose a cache adapter so it can store the generated challenges somewhere. The package ships by default with the following adapters:

- `\ZayMedia\Captcha\CacheAdapters\LaravelCacheAdapter`
- `\ZayMedia\Captcha\CacheAdapters\SimpleFileCacheAdapter`

However, you can create and use your own adapter extending the abstract adapter class:

```php
use ZayMedia\Captcha\CacheAdapters\AbstractCacheAdapter;

class MyCustomCacheAdapter extends AbstractCacheAdapter
{
    public function remember(string $key, int $expiresIn, callable $callback): mixed
    {
        //
    }

    public function get(string $key): mixed
    {
        //
    }

    public function forget(string $key): bool
    {
        //
    }
}
```

## Generate Links

You can generate / retrieve captcha links using the `generateLinks()` method. You can pass as first parameter the amount of links to generate. This method gets the generated links value from the cache, and generate if links are not found.

```php
$links = $captcha->generateLinks(amount: 3);
```

## Validate Answer

You can validate the user answer with the `validateAnswer()` method.

```php
$captcha->validateAnswer($answer);
```

## Flush Links

You can flush the current cache value and force re-generate a new captcha challenge. *It's highly recommended to use this method when the user sends a wrong a answer.*

```php
$captcha->flushLinks();
```

## Customize Options

There are some few options that you can enable / disable when generating Captcha image.

```php
// Enable or Disable image noise (Default: true)
$captcha->noise(value: false);

// Enable or Disable image background (Default: false)
$captcha->background(value: true);

// Enable or Disable dark theme (Default: false)
$captcha->darkTheme(value: true);
```

You can also customize the word universe. You can overwrite the word universe or merge your array with the default one.

```php
$wordUniverse = [...];

$captcha->wordUniverse($wordUniverse);
// Or...
$captcha->mergeWordUniverse($wordUniverse);
```

## License

Captcha is open-sourced software licensed under the [MIT license](LICENSE).
