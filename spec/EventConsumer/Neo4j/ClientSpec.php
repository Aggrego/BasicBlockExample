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

namespace spec\Aggrego\BasicBlockExample\EventConsumer\Neo4j;

use Aggrego\BasicBlockExample\EventConsumer\Neo4j\Client;
use Aggrego\EventConsumer\Client as EventConsumerClient;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
        $this->shouldHaveType(EventConsumerClient::class);
    }
}
