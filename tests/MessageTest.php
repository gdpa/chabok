<?php

namespace NotificationChannels\Chabok\Test;

use DateTime;
use Illuminate\Support\Arr;
use NotificationChannels\Chabok\ChabokMessage;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /** @var \NotificationChannels\Chabok\ChabokMessage */
    protected $message;

    public function setUp()
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
}
