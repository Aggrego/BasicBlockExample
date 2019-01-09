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

namespace spec\Aggrego\BasicBlockExample\CommandLogicUnit\ResponseProcessor\Neo4jIntegration;

use Aggrego\BasicBlockExample\CommandLogicUnit\ResponseProcessor\Neo4jIntegration\RunCommandFactory;
use Aggrego\CommandConsumer\Command;
use Aggrego\CommandConsumer\Response;
use Aggrego\CommandLogicUnit\ResponseProcessor\Factory;
use Aggrego\CommandLogicUnit\ResponseProcessor\ResponseProcessor;
use PhpSpec\ObjectBehavior;

class RunCommandFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RunCommandFactory::class);
        $this->shouldBeAnInstanceOf(Factory::class);
    }

    function it_should_factory(Command $command, Response $response)
    {
        $this->create($command, $response)->shouldReturnAnInstanceOf(ResponseProcessor::class);
    }
}
