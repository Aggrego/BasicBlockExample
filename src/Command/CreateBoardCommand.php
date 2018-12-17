<?php

namespace Aggrego\BasicBlockExample\Command;

use Aggrego\Domain\Api\Command\CreateBoard\Command as CreateBoardDomainCommand;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateBoardCommand extends Command
{
    private const PROFILE = 'profile';
    private const VERSION = 'version';
    private const DATA = 'data';

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
            ->setName('domain:create-board')
            ->setDescription('Create new board based on key data.')
            ->addArgument(self::PROFILE, InputArgument::REQUIRED, 'Profile name')
            ->addArgument(self::VERSION, InputArgument::REQUIRED, 'Profile version')
            ->addArgument(self::DATA, InputArgument::REQUIRED, 'Profile data in JSON format');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = json_decode($input->getArgument(self::DATA), true);
        if ($data === null) {
            throw new Exception('Invalid JSON');
        }

        $this->bus->dispatch(
            new CreateBoardDomainCommand(
                $data,
                $input->getArgument(self::PROFILE),
                $input->getArgument(self::VERSION)
            )
        );
    }
}
