<?php

namespace spec\Aggrego\BasicBlockExample\Domain\Profile;

use Aggrego\BasicBlockExample\Domain\Profile\Factory;
use Aggrego\Domain\Profile\Profile;
use PhpSpec\ObjectBehavior;

class FactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Factory::class);
    }

    function it_should_factory_profile(): void
    {
        $this->factory('1.0')->shouldBeAnInstanceOf(Profile::class);
    }
}
