<?php

namespace Aggrego\BasicBlockExample\Domain\Profile;

use Aggrego\Domain\Profile\Profile;
use Assert\Assertion;
use Composer\Semver\VersionParser;

class Factory
{
    public const PROFILE_NAME = 'basic_block';

    static public function factory(string $version): Profile
    {
        Assertion::regex($version, '~^([0-9]+\.{0,1})+$~');
        $normalized = (new VersionParser())->normalize($version);
        return Profile::createFromParts(self::PROFILE_NAME, $normalized);
    }
}
