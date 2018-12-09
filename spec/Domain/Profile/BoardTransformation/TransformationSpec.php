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

use Aggrego\Domain\Profile\BoardTransformation\Transformation as DomainTransformation;
use Aggrego\BasicBlockExample\Domain\Profile\BoardTransformation\Transformation;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransformationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Transformation::class);
        $this->shouldBeAnInstanceOf(DomainTransformation::class);
    }
}
