<?php

namespace Aggrego\BasicBlockExample\CommandLogicUnit\ResponseProcessor\Neo4jIntegration;

use Aggrego\CommandConsumer\Command;
use Aggrego\CommandConsumer\Response;
use Aggrego\CommandLogicUnit\ResponseProcessor\Exception\CouldNotFoundCorrespondResponseProcessorException;
use Aggrego\CommandLogicUnit\ResponseProcessor\Factory;
use Aggrego\CommandLogicUnit\ResponseProcessor\ResponseProcessor;

class RunCommandFactory implements Factory
{
    /**
     * @param Command $command
     * @param Response $response
     * @return ResponseProcessor
     * @throws CouldNotFoundCorrespondResponseProcessorException
     */
    public function create(Command $command, Response $response): ResponseProcessor
    {
        return new RunCommand();
    }
}
