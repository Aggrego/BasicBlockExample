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

namespace spec\Aggrego\BasicBlockExample\Domain\Profile\BoardTransformation;

use Aggrego\Domain\Profile\BoardTransformation\Watchman as DomainWatchman;
use Aggrego\BasicBlockExample\Domain\Profile\BoardTransformation\Watchman;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WatchmanSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Watchman::class);
        $this->shouldBeAnInstanceOf(DomainWatchman::class);
    }
}
