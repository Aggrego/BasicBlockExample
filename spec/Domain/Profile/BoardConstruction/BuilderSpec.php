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

namespace spec\Aggrego\BasicBlockExample\Domain\Profile\BoardConstruction;

use Aggrego\BasicBlockExample\Domain\Profile\BoardConstruction\Builder;
use Aggrego\BasicBlockExample\Domain\Profile\Factory;
use Aggrego\DataBoard\Board\Prototype\Board;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\BoardConstruction\Builder as DomainBuilder;
use Aggrego\Domain\Profile\BoardConstruction\Exception\UnableToBuildBoardException;
use PhpSpec\ObjectBehavior;

class BuilderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(Factory::factory('1.0'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Builder::class);
        $this->shouldBeAnInstanceOf(DomainBuilder::class);
    }

    function it_should_build_data_prototype()
    {
        $key = new Key(['name' => 'test', 'value' => 'test_value']);
        $this->build($key)->shouldBeAnInstanceOf(Board::class);
    }

    function it_should_throw_exception_with_invalid_key_name()
    {
        $key = new Key(['value' => 'test_value']);
        $unableToBuildBoardException = new UnableToBuildBoardException('Unable to create board due to: Array does not contain an element with key "name"');
        $this->shouldThrow($unableToBuildBoardException)
            ->during('build', [$key]);
    }

    function it_should_throw_exception_with_invalid_key_value()
    {
        $key = new Key(['name' => 'test']);
        $unableToBuildBoardException = new UnableToBuildBoardException('Unable to create board due to: Array does not contain an element with key "value"');
        $this->shouldThrow($unableToBuildBoardException)
            ->during('build', [$key]);
    }
}
