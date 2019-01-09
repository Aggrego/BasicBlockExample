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

namespace Aggrego\BasicBlockExample\CommandLogicUnit\ResponseProcessor\Neo4jIntegration;

use Aggrego\CommandConsumer\Command;
use Aggrego\CommandConsumer\Response;
use Aggrego\CommandLogicUnit\ResponseProcessor\ResponseProcessor;
use Aggrego\EventConsumer\Shared\Events;
use Aggrego\Neo4jIntegration\Api\Command\RunCommand\Command as RunCommandCommand;
use Aggrego\Neo4jIntegration\Api\Command\RunCommand\Response as RunCommandResponse;

class RunCommand implements ResponseProcessor
{
    /**
     * @param Command|RunCommandCommand $command
     * @param Response|RunCommandResponse $response
     */
    public function processResponse(Command $command, Response $response): void
    {
        if (!$response->isSuccess()){
            throw new \Exception(print_r($response->getPayload(), true));
        }
    }

    public function pullEvents(): Events
    {
        return new Events();
    }
}
