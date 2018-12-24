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

use GraphAware\Neo4j\Client\ClientBuilder;

class Factory
{
    public function factory(): Client
    {
        $client = ClientBuilder::create()
            ->addConnection('default', 'http://neo4j:password@localhost:7474')
            ->build();

        return new Client($client);
    }
}
