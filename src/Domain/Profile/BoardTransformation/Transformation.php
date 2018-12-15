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

namespace Aggrego\BasicBlockExample\Domain\Profile\BoardTransformation;

use Aggrego\DataBoard\Board\Board as DataBoard;
use Aggrego\DataBoard\Board\Data;
use Aggrego\DataBoard\Board\Prototype\Board as DataBoardPrototype;
use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Prototype\Board as BoardPrototype;
use Aggrego\Domain\Profile\BoardTransformation\Exception\UnprocessableBoardException;
use Aggrego\Domain\Profile\BoardTransformation\Transformation as DomainTransformation;
use Assert\Assertion;
use Exception;

class Transformation implements DomainTransformation
{
    private const KEY_NAME = 'name';
    private const KEY_VALUE = 'value';

    /**
     * @param Key $key
     * @param Board|DataBoard $board
     * @return BoardPrototype
     * @throws UnprocessableBoardException
     */
    public function transform(Key $key, Board $board): BoardPrototype
    {
        $keyValue = $key->getValue();
        try {
            Assertion::keyExists($keyValue, self::KEY_VALUE);
        } catch (Exception $e) {
            throw new UnprocessableBoardException('Unable to process board due to: ' . $e->getMessage(), 0, $e);
        }

        if (isset($keyValue[self::KEY_NAME])) {
            $key = new Key(['name' => $keyValue[self::KEY_NAME]]);
        } else {
            $key = $board->getKey();
        }

        return new DataBoardPrototype(
            $key,
            $board->getProfile(),
            new Data($keyValue[self::KEY_VALUE])
        );
    }
}
