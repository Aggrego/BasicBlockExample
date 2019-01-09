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

use Aggrego\BasicBlockExample\CommandLogicUnit\ResponseProcessor\Neo4jIntegration\RunCommand;
use Aggrego\CommandLogicUnit\ResponseProcessor\ResponseProcessor;
use PhpSpec\ObjectBehavior;

class RunCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RunCommand::class);
        $this->shouldBeAnInstanceOf(ResponseProcessor::class);
    }
}
