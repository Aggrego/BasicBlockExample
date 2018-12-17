<?php

namespace Aggrego\BasicBlockExample\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TransformBoardCommand extends Command
{
    protected static $defaultName = 'domain:transform-board';

    /** @var MessageBusInterface */
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct();
        $this->bus = $bus;
    }

    protected function configure()
    {
        $this
            ->setName('domain:transform-board')
            ->setDescription('Transform existing board with given data.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('transformation');
    }
}
