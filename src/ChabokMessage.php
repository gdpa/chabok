<?php

namespace NotificationChannels\Chabok;

class ChabokMessage
{
    /** @var string */
    protected $user;

    /** @var string */
    protected $content;

    /** @var array*/
    protected $data;
    
    /** @var string */
    protected $trackId;

    /** @var boolean */
    protected $inApp = false;

    /** @var boolean */
    protected $live = false;

    /** @var boolean */
    protected $useAsAlert = false;

    /** @var string */
    protected $alertText;
    
    /** @var integer */
    protected $ttl;

    /** @var array*/
    protected $fallback;

    /** @var string */
    protected $clientId;

    /** @var array*/
    protected $notification;

    /** @var boolean */
    protected $idr = false;

    /** @var boolean */
    protected $silent = false;

    /** @var string */
    protected $binary;
    
    /** @var string */
    protected $type;

    /** @var integer */
    protected $id;

    /**
     * @param string $user
     * @return static
     */
    public static function create($user = '')
    {
        return new static($user);
    }

    /**
     * @param string $user
     */
    public function __construct($user = '')
    {
        $this->user = $user;
    }

    /**
     * Set the user.
     *
     * @param $user
     *
     * @return $this
     */
    public function user($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set the content.
     *
     * @param $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the data.
     *
     * @param array $data
     *
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Set the trackId.
     *
     * @param $trackId
     *
     * @return $this
     */
    public function trackId($trackId)
    {
        $this->trackId = $trackId;

        return $this;
    }

    /**
     * Set the inApp.
     *
     * @return $this
     */
    public function inApp()
    {
        $this->inApp = true;

        return $this;
    }

    /**
     * Set the live.
     *
     * @return $this
     */
    public function live()
    {
        $this->live = true;

        return $this;
    }

    /**
     * Set the useAsAlert.
     *
     * @param bool $title
     * @return $this
     */
    public function alert($title = true)
    {
        if (is_bool($title)) {
            $this->useAsAlert = true;
        } else {
            $this->alertText = $title;
        }

        return $this;
    }

    /**
     * Set the ttl.
     *
     * @param $ttl
     *
     * @return $this
     */
    public function ttl($ttl)
    {
        $this->ttl = $ttl;

        return $this;
    }

    /**
     * Set the fallback.
     *
     * @param array $fallback
     *
     * @return $this
     */
    public function fallback($fallback)
    {
        $this->fallback = $fallback;

        return $this;
    }

    /**
     * Set the clientId.
     *
     * @param $clientId
     *
     * @return $this
     */
    public function clientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Set the notification.
     *
     * @param array $notification
     *
     * @return $this
     */
    public function notification($notification)
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * Set the idr.
     *
     * @return $this
     */
    public function idr()
    {
        $this->idr = true;

        return $this;
    }

    /**
     * Set the silent.
     *
     * @return $this
     */
    public function silent()
    {
        $this->silent = true;

        return $this;
    }

    /**
     * Set the binary.
     *
     * @param $binary
     *
     * @return $this
     */
    public function binary($binary)
    {
        $this->binary = $binary;

        return $this;
    }

    /**
     * Set the type.
     *
     * @param $type
     *
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the id.
     *
     * @param $id
     *
     * @return $this
     */
    public function id($id)
    {
        $this->id = $id;

        return $this;
    }
    
    /**
     * @return array
     */
    public function toArray()
    {
        $parameters = [
            'user' => $this->user,
            'content' => $this->content,
        ];
        if ($this->data)
            $parameters = array_merge($parameters, ['data' => $this->data]);

        if ($this->trackId)
            $parameters = array_merge($parameters, ['trackId' => $this->trackId]);

        if ($this->inApp)
            $parameters = array_merge($parameters, ['inApp' => true]);

        if ($this->live)
            $parameters = array_merge($parameters, ['live' => true]);

        if ($this->useAsAlert)
            $parameters = array_merge($parameters, ['useAsAlert' => true]);

        if ($this->useAsAlert)
            $parameters = array_merge($parameters, ['useAsAlert' => true]);

        if ($this->alertText)
            $parameters = array_merge($parameters, ['alertText' => $this->alertText]);

        if ($this->ttl)
            $parameters = array_merge($parameters, ['ttl' => $this->ttl]);

        if ($this->fallback)
            $parameters = array_merge($parameters, ['fallback' => $this->fallback]);

        if ($this->clientId)
            $parameters = array_merge($parameters, ['clientId' => $this->clientId]);

        if ($this->notification)
            $parameters = array_merge($parameters, ['notification' => $this->notification]);

        if ($this->idr)
            $parameters = array_merge($parameters, ['idr' => true]);

        if ($this->silent)
            $parameters = array_merge($parameters, ['silent' => true]);

        if ($this->binary)
            $parameters = array_merge($parameters, ['contentBinary' => $this->binary]);

        if ($this->type)
            $parameters = array_merge($parameters, ['contentType' => $this->type]);

        if ($this->id)
            $parameters = array_merge($parameters, ['id' => $this->id]);

        return $parameters;
    }
}
