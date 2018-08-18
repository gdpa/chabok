# Chabok notifications channel for Laravel 5.3+

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gdpa/chabok.svg?style=flat-square)](https://packagist.org/packages/gdpa/chabok)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/gdpa/chabok/master.svg?style=flat-square)](https://travis-ci.org/gdpa/chabok)
[![StyleCI](https://styleci.io/repos/145205024/shield)](https://github.styleci.io/accounts/145205024)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/9015691f-130d-4fca-8710-72a010abc684.svg?style=flat-square)](https://insight.sensiolabs.com/projects/9015691f-130d-4fca-8710-72a010abc684)
[![Quality Score](https://img.shields.io/scrutinizer/g/chabok/chabok.svg?style=flat-square)](https://scrutinizer-ci.com/g/gdpa/chabok)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/gdpa/chabok/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/gdpa/chabok/?branch=master)
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

This method needs to return an array containing the access token of the authorized Chabok user (if it's a private board) and the list ID of the Chabok list to add the card to.

```php
public function routeNotificationForChabok()
{
    return [
        'token' => 'NotifiableToken',
        'idList' => 'ChabokListId',
    ];
}
```

### Available methods

- `content('')`: Accepts a string value for the Chabok notification content.
- `data([])`: Accepts a array for the Chabok notification data.


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
