<?php

namespace spec\Aggrego\BasicBlockExample\Messanger\Handler;

use Aggrego\BasicBlockExample\Messanger\Handler\CreateBoardHandler;
use Aggrego\Domain\Api\Command\CreateBoard\UseCase;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateBoardHandlerSpec extends ObjectBehavior
{
    function let(UseCase $case)
    {
        $this->beConstructedWith($case);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateBoardHandler::class);
        $this->shouldHaveType(MessageHandlerInterface::class);
    }
}
