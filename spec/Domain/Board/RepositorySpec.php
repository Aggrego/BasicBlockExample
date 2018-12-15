<?php

namespace spec\Aggrego\BasicBlockExample\Domain\Board;

use Aggrego\BasicBlockExample\Domain\Board\Repository;
use Aggrego\Domain\Board\Repository as DomainRepository;
use PhpSpec\ObjectBehavior;

class RepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Repository::class);
        $this->shouldHaveType(DomainRepository::class);
    }
}
