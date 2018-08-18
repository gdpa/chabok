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

    /**
     * @param string $user
     * @return static
     */
    public static function create($user = '')
    {
        return new static($user);
    }

    /**
     * @param array $user
     */
    public function __construct($user = [])
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
     * @return array
     */
    public function toArray()
    {
        return [
            'user' => $this->user,
            'content' => $this->content,
            'data' => $this->data,
        ];
    }
}
