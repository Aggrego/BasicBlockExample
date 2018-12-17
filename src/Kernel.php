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

namespace Aggrego\BasicBlockExample;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;
use Symfony\Component\Messenger\DependencyInjection\MessengerPass;

final class Kernel extends SymfonyKernel
{
    public function registerBundles()
    {
        return [];
    }

    public function getCacheDir()
    {
        return dirname(__DIR__) . '/var/cache/api/' . $this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__) . '/var/log/api';
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/../config/services.yaml');
    }

    protected function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new MessengerPass());
        $container->addCompilerPass(new AddConsoleCommandPass());
    }
}
