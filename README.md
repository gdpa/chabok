# Chabok notifications channel for Laravel 5.3+

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gdpa/chabok.svg?style=flat-square)](https://packagist.org/packages/gdpa/chabok)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/gdpa/chabok/master.svg?style=flat-square)](https://travis-ci.org/gdpa/chabok)
[![StyleCI](https://styleci.io/repos/145205024/shield)](https://github.styleci.io/accounts/145205024)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gdpa/chabok/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gdpa/chabok/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/gdpa/chabok/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gdpa/chabok/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/gdpa/chabok.svg?style=flat-square)](https://packagist.org/packages/gdpa/chabok)

This package makes it easy to sent [Chabok](https://chabokpush.com//) Notifications with Laravel 5.3+.

## Contents

- [Installation](#installation)
    - [Setting up the Chabok service](#setting-up-the-chabok-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
composer require gdpa/chabok
```

### Setting up the Chabok service

Add your Chabok REST API Key to your `config/services.php`:

```php
// config/services.php
...
'chabok' => [
    'app_id' => env('CHABOK_APP_ID'), 
    'key' => env('CHABOK_API_KEY'),
],
...
```

**Note: If you want to test chabok set `app_id` to `sandbox`.**

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\Chabok\ChabokChannel;
use NotificationChannels\Chabok\ChabokMessage;
use Illuminate\Notifications\Notification;

class ProjectCreated extends Notification
{
    public function via($notifiable)
    {
        return [ChabokChannel::class];
    }

    public function toChabok($notifiable)
    {
        return ChabokMessage::create()
            ->content("This is the Chabok notification description")
            ->data(['id' => 1, 'title' => 'This is notification data']);
    }
}
```

In order to let your Notification know which Chabok user you are targeting, add the `routeNotificationForChabok` method to your Notifiable model.

This method needs to return an uuid containing the your registered token on chabok.

```php
public function routeNotificationForChabok()
{
    return [
        'uuid' => 'user-uuid-which-set-on-chabok-by-client',
    ];
}
```

### Available methods

- `content('')`: Accepts a string value for the Chabok notification content.
- `trackId('')`: Accepts a string value for the Chabok notification trackId.
- `inApp()`: Call this if you want to set the Chabok notification inApp to true.
- `live()`: Call this if you want to set the Chabok notification live to true.
- `alert(''')`: Call this with no parameters if you want to set the Chabok notification useAsAlert to true. If you provide some string, it will set as alert text.
- `ttl('')`: Accepts a integer value for the Chabok notification ttl.
- `data([])`: Accepts a array for the Chabok notification data.
- `fallback([])`: Accepts a array for the Chabok notification fallback.
- `clientId('')`: Accepts a string value for the Chabok notification clientId.
- `notification([])`: Accepts a array for the Chabok notification notification.
- `idr()`: Call this if you want to set the Chabok notification idr to true.
- `silent()`: Call this if you want to set the Chabok notification silent to true.
- `binary('')`: Accepts a string value for the Chabok notification contentBinary.
- `type('')`: Accepts a string value for the Chabok notification contentType.
- `id('')`: Accepts a number value for the Chabok notification id.


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email morteza.poussaneh@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Morteza Poussaneh](https://github.com/gdpa)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
