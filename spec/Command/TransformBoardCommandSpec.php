<?php

namespace spec\Aggrego\BasicBlockExample\Command;

use Aggrego\BasicBlockExample\Command\TransformBoardCommand;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Messenger\MessageBusInterface;

class TransformBoardCommandSpec extends ObjectBehavior
{
    function let(MessageBusInterface $bus)
    {
        $this->beConstructedWith($bus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TransformBoardCommand::class);
        $this->shouldHaveType(Command::class);
    }
}
