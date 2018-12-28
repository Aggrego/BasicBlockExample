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

namespace Aggrego\BasicBlockExample\Neo4jEvenConsumer\Middleware;

use Aggrego\DataBoard\Board\Events\BoardCreatedEvent;
use GraphAware\Neo4j\Client\Client;

class DataBoardCreatedEventHandler
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function handle(BoardCreatedEvent $event): void
    {
        $payload = $event->getPayload();
        $boardUuidValue = $event->getDomain()->getUuid()->getValue();
        $this->client->run(
            'CREATE (b:Event) SET b += {data}',
            ['data' =>
                [
                    'domain_name' => $event->getDomain()->getName()->getValue(),
                    'uuid' => $boardUuidValue,
                    'version' => $event->getVersion()->getValue(),
                    'created_at' => $event->createdAt()->getValue(),
                    'payload' => json_encode($payload)
                ]
            ]
        );

        if ($payload['parent_uuid'] != null) {
            $this->client->run(
                'MATCH (u:Event {uuid:{uuid}}), (p:Event {uuid:{parent_uuid}}) CREATE (u)-[:CREATED_FROM]->(p)',
                [
                    'uuid' => $boardUuidValue,
                    'parent_uuid' => $payload['parent_uuid']
                ]
            );
        }
    }
}
