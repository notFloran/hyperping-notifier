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
    public function __construct(private readonly TexterInterface $texter)
    {
    }

    public function consume(RemoteEvent $event): void
    {
        $payload = $event->getPayload();

        if (false === array_key_exists('text', $payload)) {
            return;
        }

        $notification = (new PushMessage('Monitoring', $payload['text']));

        $this->texter->send($notification);
    }
}
