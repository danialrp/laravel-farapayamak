<?php

namespace DanialPanah\Farapayamak\Traits;

trait FarapayamakMessage {
    /**
     * Message content
     *
     * @var string
     */
    private $text;

    /**
     * Message recipients
     *
     * @var array|string
     */
    private $recipients;

    /**
     * @param array|string $recipients
     */
    public function setRecipients($recipients): void
    {
        is_array($recipients) ? $this->recipients = (string)implode(',', $recipients) : $this->recipients = $recipients;
    }


}