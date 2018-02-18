<?php

namespace App\Services\External;

use Telegram;

class TelegramClient
{

    private $token;
    private $chatId;

    /** @var Telegram */
    private $internalTelegramClient;

    public function __construct(string $token, int $chatId)
    {
        $this->token = $token;
        $this->chatId = $chatId;

        $this->internalTelegramClient = new Telegram($this->token);
    }

    public function sendTelegramMessage(string $message = 'empty')
    {
        $content  = ['chat_id' => $this->chatId, 'text' => $message];
        $this->internalTelegramClient->sendMessage($content);
    }
}
