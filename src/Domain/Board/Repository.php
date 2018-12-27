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

namespace Aggrego\BasicBlockExample\Domain\Board;

use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Exception\BoardExistException;
use Aggrego\Domain\Board\Exception\BoardNotFoundException;
use Aggrego\Domain\Board\Repository as DomainRepository;
use Aggrego\Domain\Board\Uuid;

class Repository implements DomainRepository
{
    /** @var string */
    private $dir;

    public function __construct()
    {
        $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'AggregoBoardRepository' . DIRECTORY_SEPARATOR;
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
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
        if (!file_exists($filePath)) {
            throw new BoardExistException(sprintf('Given "%s" don\'t exists in "%s"', $boardUuidValue, $filePath));
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
            throw new BoardExistException(sprintf('Given "%s" exists', $boardUuidValue));
        }
        file_put_contents($filePath, serialize($board));
    }
}
