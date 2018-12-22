<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Aggrego\BasicBlockExample\Command;

use Aggrego\Domain\Api\Command\CreateBoard\Command as CreateBoardDomainCommand;
use Assert\Assertion;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateBoardCommand extends Command
{
    private const PROFILE = 'profile';
    private const VERSION = 'version';
    private const DATA_FILE_SOURCE = 'data_file_source';

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
            ->addOption(self::DATA_FILE_SOURCE, 'f', InputOption::VALUE_REQUIRED, 'Profile data in JSON format in file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = null;
        $file = $input->getOption(self::DATA_FILE_SOURCE);
        if ($file) {
            Assertion::file($file);
            $fileContent = file_get_contents($file);
            Assertion::isJsonString($fileContent);
            $data = json_decode($fileContent, true);
        }

        if ($data === null) {
            throw new Exception('No data was loaded correctly.');
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
