<?php

namespace NotificationChannels\Chabok\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static('Chabok responded with an error: `'.$response->getBody()->getContents().'`');
    }
}
