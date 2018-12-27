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

namespace spec\Aggrego\BasicBlockExample\Neo4jEvenConsumer\Middleware;

use Aggrego\BasicBlockExample\Neo4jEvenConsumer\Middleware\DataBoardCreatedEventHandler;
use GraphAware\Neo4j\Client\Client;
use PhpSpec\ObjectBehavior;

class DataBoardCreatedEventHandlerSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DataBoardCreatedEventHandler::class);
    }
}
