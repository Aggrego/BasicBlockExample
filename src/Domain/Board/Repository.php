<?php

namespace Aggrego\BasicBlockExample\Domain\Board;

use Aggrego\AggregateEventConsumer\Uuid;
use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Exception\BoardExistException;
use Aggrego\Domain\Board\Exception\BoardNotFoundException;
use Aggrego\Domain\Board\Repository as DomainRepository;

class Repository implements DomainRepository
{
    /** @var string */
    private $dir;

    public function __construct()
    {
        $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'AggregoBoardRepository' . DIRECTORY_SEPARATOR;
        mkdir($dir, 0777, true);
        $this->dir = $dir;
    }

    /**
     * @param Uuid $uuid
     * @return Board
     * @throws BoardNotFoundException
     */
    public function getBoardByUuid(Uuid $uuid): Board
    {
        $boardUuidValue = $uuid->getValue();
        $filePath = $this->dir . $boardUuidValue . '.data';
        if (file_exists($filePath)) {
            throw new BoardExistException(sprintf('Given "%s" exists' . $boardUuidValue));
        }

        $content = file_get_contents($filePath);
        return unserialize($content);
    }

    /**
     * @param Board $board
     * @throws BoardExistException
     */
    public function addBoard(Board $board): void
    {
        $boardUuidValue = $board->getUuid()->getValue();
        $filePath = $this->dir . $boardUuidValue . '.data';
        if (file_exists($filePath)) {
            throw new BoardExistException(sprintf('Given "%s" exists' . $boardUuidValue));
        }
        file_put_contents($filePath, serialize($board));
    }
}
