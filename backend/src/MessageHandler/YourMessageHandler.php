<?php
namespace App\MessageHandler;

use App\Message\YourMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class YourMessageHandler
{
    public function __invoke(YourMessage $message)
    {
        echo $message->getContent();
    }
}

