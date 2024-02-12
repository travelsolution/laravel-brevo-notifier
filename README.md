# laravel-brevo-notifier

Easily send Brevo transactional email and sms with Laravel notifier.

## Installation

	composer require travelsolution/laravel-brevo-notifier

## Configure

Just define these environment variables:

```dotenv
BREVO_KEY=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
BREVO_SMS_SENDER=
```

Make sure that MAIL_FROM_ADDRESS is an authenticated email on Brevo.

BREVO_SMS_SENDER is limited to 11 for alphanumeric characters and 15 for numeric characters.

You can publish the configuration file with:

```shell
php artisan vendor:publish --provider="TravelSolution\LaravelBrevoNotifier\BrevoNotifierServiceProvider" --tag="config"
```

## Usage

### Send email

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use TravelSolution\LaravelBrevoNotifier\BrevoEmailChannel;
use TravelSolution\LaravelBrevoNotifier\BrevoEmailMessage;

class OrderConfirmation extends Notification
{
    public function via(): array
    {
        return [BrevoEmailChannel::class];
    }

    public function toBrevoEmail($notifiable): BrevoEmailMessage
    {
        return (new BrevoEmailMessage())
            ->templateId(1)
            ->to($notifiable->firstname, $notifiable->email)
            ->params(['order_ref' => 'N°0000001']);
    }
}
```

### Send sms

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification
use TravelSolution\LaravelBrevoNotifier\BrevoSmsChannel;
use TravelSolution\LaravelBrevoNotifier\BrevoSmsMessage;

class OrderConfirmation extends Notification
{
    public function via()
    {
        return [BrevoSmsChannel::class];
    }

    public function toBrevoSms($notifiable): BrevoSmsMessage
    {
        return (new BrevoSmsMessage())
            ->from('TravelSolution')
            ->to('+33626631711')
            ->content('Your order is confirmed.');
    }
}
```

## Unit tests

To run the tests, just run `composer install` and `composer test`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [David Tang](https://github.com/dtangdev)
- [James Hemery](https://github.com/jameshemery)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
