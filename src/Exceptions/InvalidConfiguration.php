<?php

namespace NotificationChannels\Chabok\Exceptions;

class InvalidConfiguration extends \Exception
{
    public static function configurationNotSet()
    {
        return new static('In order to send notification via Chabok you need to add credentials in the `chabok` key of `config.services`.');
    }
}
