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

use Aggrego\CommandLogicUnit\EventProcessor\CommandCollection;
use Aggrego\CommandLogicUnit\EventProcessor\EventProcessor;
use Aggrego\DataBoard\Board\Events\BoardCreatedEvent as DataBoardCreatedEvent;
use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Exception\UnprocessableEventException;

class BoardCreatedEvent implements EventProcessor
{
    /**
     * @param Event $event
     * @return CommandCollection
     * @throws UnprocessableEventException if event (payload) have invalid structure.
     */
    public function transform(Event $event): CommandCollection
    {
        if (!$event instanceof DataBoardCreatedEvent){
        }
    }
}
