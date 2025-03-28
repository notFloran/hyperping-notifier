# Hypering Notifier

This project serves as a webhook integration for Hyperping, sending notifications via **Pushover** (or another service) when your website experiences downtime.

## Prerequisites

Before getting started, make sure you have the following installed and configured:

- PHP 8.4 or higher
- Composer

## Installation

```bash
git clone https://github.com/your-username/hypering-notifier.git
cd hypering-notifier
composer install
```

Create a `.env.local file at the root of the project and define the following variable:

```
WEBHOOK_SECRET=
```

To use Pushover for notifications, set the following variable (see Pushover documentation for assistance):

```
PUSHOVER_DSN=pushover://USER_KEY:APP_TOKEN@default
```

If you wish to use a different notification service, you can install a Symfony Notifier package. For more information, refer to the [Symfony Notifier documentation](https://symfony.com/doc/current/notifier.html#notifier-push-channel).

## Create the webhook integration

Go to https://app.hyperping.io/integrations/webhook and set the following endpoint : `https://your-app/webhook/hyperping?secret=YOUR_SECRET`

## License

[hyperping-notifier](https://github.com/notfloran/hyperping-notifier) is licensed under the [MIT license](LICENSE).
