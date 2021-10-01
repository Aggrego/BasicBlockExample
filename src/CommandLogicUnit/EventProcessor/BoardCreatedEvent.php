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

namespace Aggrego\BasicBlockExample\CommandLogicUnit\EventProcessor;

use Aggrego\BasicBlockDomainProfile\Domain\Profile\Factory;
use Aggrego\CommandLogicUnit\EventProcessor\CommandCollection as CommandLogicUnitCommandCollection;
use Aggrego\CommandLogicUnit\EventProcessor\EventProcessor;
use Aggrego\CommandLogicUnit\Shared\EventProcessor\CommandCollection;
use Aggrego\DataDomainBoard\Board\Events\BoardCreatedEvent as DataBoardCreatedEvent;
use Aggrego\Domain\Profile\Profile;
use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Exception\UnprocessableEventException;
use Aggrego\Neo4jIntegration\Api\Command\RunCommand\Command;

class BoardCreatedEvent implements EventProcessor
{
    /**
     * @param Event $event
     * @return CommandLogicUnitCommandCollection
     * @throws UnprocessableEventException if event (payload) have invalid structure.
     */
    public function transform(Event $event): CommandLogicUnitCommandCollection
    {
        if ($event->getName()->getValue() != DataBoardCreatedEvent::class) {
            return new CommandCollection();
        }

        $payload = $event->getPayload();
        $profile = Profile::createFromName($payload['profile']);
        if (Factory::PROFILE_NAME != $profile->getName()) {
            return new CommandCollection();
        }
        $boardUuidValue = $payload['uuid'];

        $list[] = new Command(
            'CREATE (b:Event) SET b += {data}',
            [
                'data' =>
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
            $list[] = new Command(
                'MATCH (c:Event {uuid:{uuid}}), (p:Event {uuid:{parent_uuid}}) CREATE (c)-[:CREATED_FROM]->(p)',
                [
                    'uuid' => $boardUuidValue,
                    'parent_uuid' => $payload['parent_uuid']
                ]
            );
        }

//        $this->client->run(
//            'CREATE (b:Board) SET b += {data}',
//            ['data' =>
//                [
//                    'uuid' => $boardUuidValue,
//                    'name' => $payload['metadata']
//                ]
//            ]
//        );
//
//        $this->client->run(
//            'MATCH (u:Event {uuid:{uuid}}), (b:Board {uuid:{board_uuid}}) CREATE (u)<-[:BUILD_FROM]-(b)',
//            [
//                'uuid' => $boardUuidValue,
//                'board_uuid' => $boardUuidValue
//            ]
//        );

        return new CommandCollection(...$list);
    }
}
