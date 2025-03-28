<?php

namespace App\RemoteEvent;

use Symfony\Component\Notifier\Message\PushMessage;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\RemoteEvent\Attribute\AsRemoteEventConsumer;
use Symfony\Component\RemoteEvent\Consumer\ConsumerInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;

#[AsRemoteEventConsumer('hyperping')]
final class HyperpingWebhookConsumer implements ConsumerInterface
{
    private const string UP = 'check.up';

    private const string DOWN = 'check.down';

    public function __construct(private readonly TexterInterface $texter)
    {
    }

    public function consume(RemoteEvent $event): void
    {
        $payload = $event->getPayload();

        $event = $payload['event'];
        $checkPayload = $payload['check'];

        $title = sprintf('%s %s', $event == self::UP ? '✅' : '🚨', $payload['text']);
        $content = sprintf(
            "URL: %s\nStatus: %s",
            $checkPayload['url'],
            $checkPayload['status'],
        );

        $this->texter->send(new PushMessage($title, $content));
    }
}
