<?php

namespace spec\Aggrego\BasicBlockExample\Messanger\Handler;

use Aggrego\BasicBlockExample\Messanger\Handler\TransformBoardHandler;
use Aggrego\Domain\Api\Command\TransformBoard\UseCase;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class TransformBoardHandlerSpec extends ObjectBehavior
{
    function let(UseCase $case)
    {
        $this->beConstructedWith($case);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TransformBoardHandler::class);
        $this->shouldHaveType(MessageHandlerInterface::class);
    }
}
