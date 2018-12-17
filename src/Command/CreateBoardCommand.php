<?php

namespace Aggrego\BasicBlockExample\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateBoardCommand extends Command
{
//    protected static $defaultName = 'domain:create-board';

    /** @var MessageBusInterface */
    private $bus;

//    public function __construct(MessageBusInterface $bus)
//    {
//        parent::__construct();
//        $this->bus = $bus;
//    }

    protected function configure()
    {
        $this
            ->setName('domain:create-board')
            ->setDescription('Create new board based on key data.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('creating');
    }
}
