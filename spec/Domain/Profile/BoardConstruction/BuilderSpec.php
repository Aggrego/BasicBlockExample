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

namespace spec\Aggrego\BasicBlockExample\Domain\Profile\BoardConstruction;

use Aggrego\Domain\Profile\BoardConstruction\Builder as DomainBuilder;
use Aggrego\BasicBlockExample\Domain\Profile\BoardConstruction\Builder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Builder::class);
        $this->shouldBeAnInstanceOf(DomainBuilder::class);
    }
}
