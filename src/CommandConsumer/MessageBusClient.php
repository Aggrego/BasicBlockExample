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

namespace Aggrego\BasicBlockExample\CommandConsumer;

use Aggrego\CommandConsumer\Client;
use Aggrego\CommandConsumer\Command;
use Aggrego\CommandConsumer\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class MessageBusClient implements Client
{
    /** @var MessageBusInterface */
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function consume(Command $command): Response
    {
        $envelop =  $this->bus->dispatch($command);
        /** @var HandledStamp $stamp */
        $stamp = $envelop->last(HandledStamp::class);
        return $stamp = $stamp->getResult();
    }
}
