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

namespace Aggrego\BasicBlockExample\EventConsumer\Neo4j;

use Aggrego\EventConsumer\Client as EventConsumerClient;
use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Exception\UnprocessableEventException;
use GraphAware\Neo4j\Client\Client as Neo4jClient;

class Client implements EventConsumerClient
{
    /**
     * @var Neo4jClient
     */
    private $client;

    public function __construct(Neo4jClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param Event $event
     * @throws UnprocessableEventException if event (payload) have invalid structure.
     */
    public function consume(Event $event): void
    {
        var_dump(__FILE__);
    }
}
