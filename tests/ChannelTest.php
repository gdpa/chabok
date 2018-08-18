<?php

namespace NotificationChannels\Chabok\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Notifications\Notification;
use Mockery;
use NotificationChannels\Chabok\Exceptions\CouldNotSendNotification;
use NotificationChannels\Chabok\Exceptions\InvalidConfiguration;
use NotificationChannels\Chabok\ChabokChannel;
use NotificationChannels\Chabok\ChabokMessage;
use Orchestra\Testbench\TestCase;

class ChannelTest extends TestCase
{
    /** @test */
    public function it_can_send_a_notification()
    {
        $this->app['config']->set('services.chabok.app_id', 'sandbox');
        $this->app['config']->set('services.chabok.key', 'ChabokKey');

        $response = new Response(200);
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('post')
            ->once()
            ->with('https://sandbox.push.adpdigital.com/api?access_token=ChabokKey', [
                    'form_params' => [
                        'user' => ['UserUUID'],
                        'content' => 'ChabokDescription',
                        'data' => ['id' => 1],
                    ],
                ])
            ->andReturn($response);
        $channel = new ChabokChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }

    /** @test */
    public function it_throws_an_exception_when_it_is_not_configured()
    {
        $this->setExpectedException(InvalidConfiguration::class);

        $client = new Client();
        $channel = new ChabokChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }

    /** @test */
    public function it_throws_an_exception_when_it_could_not_send_the_notification()
    {
        $this->setExpectedException(CouldNotSendNotification::class);

        $this->app['config']->set('services.chabok.key', 'ChabokKey');

        $response = new Response(500);
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('post')
            ->once()
            ->andReturn($response);
        $channel = new ChabokChannel($client);
        $channel->send(new TestNotifiable(), new TestNotification());
    }
}

class TestNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return array
     */
    public function routeNotificationForChabok()
    {
        return ['uuid' => ['UserUUID']];
    }
}


class TestNotification extends Notification
{
    public function toChabok($notifiable)
    {
        return
            (new ChabokMessage())
                ->content('ChabokDescription')
                ->data(['id' => 1]);
    }
}
