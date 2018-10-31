<?php

namespace NotificationChannels\Chabok;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use NotificationChannels\Chabok\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;
use NotificationChannels\Chabok\Exceptions\InvalidConfiguration;

class ChabokChannel
{
    private static $API_ENDPOINT;

    /** @var Client */
    protected $client;

    /** @param Client $client */
    public function __construct(Client $client)
    {
        $this->client = $client;
        self::$API_ENDPOINT = 'https://' . config('services.chabok.app_id') . '.push.adpdigital.com/api/push/toUsers';
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\Chabok\Exceptions\InvalidConfiguration
     * @throws \NotificationChannels\Chabok\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $routing = collect($notifiable->routeNotificationFor('Chabok'));

        if ($routing->isEmpty()) {
            return;
        }

        $key = config('services.chabok.key');

        if (is_null($key)) {
            throw InvalidConfiguration::configurationNotSet();
        }

        $chabokParameters = $notification->toChabok($notifiable)->toArray();

        $response = $this->client->post(self::$API_ENDPOINT.'?access_token='.$key, [
            'form_params' => Arr::set($chabokParameters, 'user', $routing->get('uuid')),
        ]);

        if ($response->getStatusCode() !== 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }
}
