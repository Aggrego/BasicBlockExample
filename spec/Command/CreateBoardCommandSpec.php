<?php

namespace spec\Aggrego\BasicBlockExample\Command;

use Aggrego\BasicBlockExample\Command\CreateBoardCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateBoardCommandSpec extends ObjectBehavior
{
    function let(MessageBusInterface $bus)
    {
        $this->beConstructedWith($bus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateBoardCommand::class);
        $this->shouldHaveType(Command::class);
    }
}
