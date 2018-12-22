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

use Aggrego\Domain\Api\Command\TransformBoard\Command as TransformBoardDomainCommand;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TransformBoardCommand extends Command
{
    private const BOARD_UUID = 'board_uuid';
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
            ->setName('domain:transform-board')
            ->setDescription('Transform existing board with given data.')
            ->addArgument(self::BOARD_UUID, InputArgument::REQUIRED, 'Board uuid')
            ->addArgument(self::DATA, InputArgument::REQUIRED, 'Profile data in JSON format');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = json_decode($input->getArgument(self::DATA), true);
        if ($data === null) {
            throw new Exception('Invalid JSON');
        }
        $this->bus->dispatch(
            new TransformBoardDomainCommand(
                $input->getArgument(self::BOARD_UUID),
                $data
            )
        );
    }
}
