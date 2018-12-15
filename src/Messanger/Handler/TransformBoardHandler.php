<?php

namespace Aggrego\BasicBlockExample\Messanger\Handler;

use Aggrego\Domain\Api\Command\TransformBoard\Command;
use Aggrego\Domain\Api\Command\TransformBoard\UseCase;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class TransformBoardHandler implements MessageHandlerInterface
{
    /** @var UseCase */
    private $useCase;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(Command $message): void
    {
        $this->useCase->handle($message);
    }
}
