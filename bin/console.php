#!/usr/bin/env php
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

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Messenger\DependencyInjection\MessengerPass;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../config/'));
$loader->load('services.yaml');
$container->addCompilerPass(new MessengerPass());
$container->addCompilerPass(new AddConsoleCommandPass());
$container->compile();

/** @var Application $application */
$application = $container->get(Application::class);
foreach ($container->getParameter('console.command.ids') as $id) {
    $application->add($container->get($id));
}
$application->add($container->get('console.command.messenger_debug'));
$application->run();

