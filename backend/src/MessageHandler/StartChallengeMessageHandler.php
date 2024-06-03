<?php
namespace App\MessageHandler;

use App\Message\StartChallengeMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class StartChallengeMessageHandler
{
    public function __invoke(StartChallengeMessage $message)
    {
        echo $message->getChallengeId();
    }
}

