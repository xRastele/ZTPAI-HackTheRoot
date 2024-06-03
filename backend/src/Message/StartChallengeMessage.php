<?php
namespace App\Message;

class StartChallengeMessage
{
    private string $challengeId;
    private string $timeout;

    public function __construct(string $challengeId, string $timeout)
    {
        $this->challengeId = $challengeId;
        $this->timeout = $timeout;
    }

    public function getChallengeId(): string
    {
        return $this->challengeId;
    }

    public function getTimeout(): string
    {
        return $this->timeout;
    }
}
