<?php

namespace Aggrego\BasicBlockExample\Messanger\Handler;

use Aggrego\Domain\Api\Command\CreateBoard\Command;
use Aggrego\Domain\Api\Command\CreateBoard\UseCase;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateBoardHandler implements MessageHandlerInterface
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
