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

use Symfony\Component\Console\Application;

$kernel = new \Aggrego\BasicBlockExample\Kernel(
    $_SERVER['APP_ENV'] ?? 'dev',
    $_SERVER['APP_DEBUG'] ?? ('prod' !== ($_SERVER['APP_ENV'] ?? 'dev'))
);
$kernel->boot();

$container = $kernel->getContainer();
/** @var Application $application */
$application = $container->get(Application::class);
$application->run();