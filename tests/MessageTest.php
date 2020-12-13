<?php

namespace NotificationChannels\Chabok\Test;

use Illuminate\Support\Arr;
use NotificationChannels\Chabok\ChabokMessage;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /** @var \NotificationChannels\Chabok\ChabokMessage */
    protected $message;

    protected function setUp(): void
    {
        parent::setUp();

        $this->message = new ChabokMessage();
    }

    /** @test */
    public function it_accepts_a_user_when_constructing_a_message()
    {
        $message = new ChabokMessage('User');

        $this->assertEquals('User', Arr::get($message->toArray(), 'user'));
    }

    /** @test */
    public function it_provides_a_create_method()
    {
        $message = ChabokMessage::create('User');

        $this->assertEquals('User', Arr::get($message->toArray(), 'user'));
    }

    /** @test */
    public function it_can_set_the_user()
    {
        $this->message->user('uuid');

        $this->assertEquals('uuid', Arr::get($this->message->toArray(), 'user'));
    }

    /** @test */
    public function it_can_set_the_content()
    {
        $this->message->content('MyDescription');

        $this->assertEquals('MyDescription', Arr::get($this->message->toArray(), 'content'));
    }

    /** @test */
    public function it_can_set_the_data()
    {
        $this->message->data(['id' => 85]);

        $this->assertEquals(['id' => 85], Arr::get($this->message->toArray(), 'data'));
    }

    /** @test */
    public function it_can_set_the_track_id()
    {
        $this->message->trackId('track_id');
        $this->assertEquals('track_id', Arr::get($this->message->toArray(), 'trackId'));
    }

    /** @test */
    public function it_can_set_the_in_app()
    {
        $this->message->inApp();
        $this->assertTrue(Arr::get($this->message->toArray(), 'inApp'));
    }

    /** @test */
    public function it_can_set_the_live()
    {
        $this->message->live();
        $this->assertTrue(Arr::get($this->message->toArray(), 'live'));
    }

    /** @test */
    public function it_can_set_the_use_as_alert()
    {
        $this->message->alert();
        $this->assertTrue(Arr::get($this->message->toArray(), 'useAsAlert'));
    }

    /** @test */
    public function it_can_set_the_alert_text()
    {
        $this->message->alert('this is text');
        $this->assertEquals('this is text', Arr::get($this->message->toArray(), 'alertText'));
    }

    /** @test */
    public function it_can_set_the_ttl()
    {
        $this->message->ttl(50);
        $this->assertEquals(50, Arr::get($this->message->toArray(), 'ttl'));
    }

    /** @test */
    public function it_can_set_the_fallback()
    {
        $this->message->fallback(['message' => 'hi there']);

        $this->assertEquals(['message' => 'hi there'], Arr::get($this->message->toArray(), 'fallback'));
    }

    /** @test */
    public function it_can_set_the_client_id()
    {
        $this->message->clientId('client_id');
        $this->assertEquals('client_id', Arr::get($this->message->toArray(), 'clientId'));
    }

    /** @test */
    public function it_can_set_the_notification()
    {
        $this->message->notification(['message' => 'hi there']);

        $this->assertEquals(['message' => 'hi there'], Arr::get($this->message->toArray(), 'notification'));
    }

    /** @test */
    public function it_can_set_the_idr()
    {
        $this->message->idr();
        $this->assertTrue(Arr::get($this->message->toArray(), 'idr'));
    }

    /** @test */
    public function it_can_set_the_silent()
    {
        $this->message->silent();
        $this->assertTrue(Arr::get($this->message->toArray(), 'silent'));
    }

    /** @test */
    public function it_can_set_the_binary()
    {
        $this->message->binary('this is binary');
        $this->assertEquals('this is binary', Arr::get($this->message->toArray(), 'contentBinary'));
    }

    /** @test */
    public function it_can_set_the_type()
    {
        $this->message->type('this is type');
        $this->assertEquals('this is type', Arr::get($this->message->toArray(), 'contentType'));
    }

    /** @test */
    public function it_can_set_the_id()
    {
        $this->message->id(111);
        $this->assertEquals(111, Arr::get($this->message->toArray(), 'id'));
    }
}
