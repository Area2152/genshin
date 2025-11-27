<?php

namespace Helpers;

class Message
{
    public const COLOR_SUCCESS = 'message--success';
    public const COLOR_ERROR   = 'message--error';
    public const COLOR_INFO    = 'message--info';

    private string $message;
    private string $color;
    private string $title;

    public function __construct(
        string $message,
        string $color = self::COLOR_INFO,
        string $title = 'Message'
    ) {
        $this->message = $message;
        $this->color   = $color;
        $this->title   = $title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
