<?php

declare(strict_types=1);

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Boot\ConfigurationProviderBootLoader;
use Micro\Framework\Kernel\Boot\DependencyProviderBootLoader;
use Micro\Framework\Kernel\Kernel;
use Micro\Framework\Kernel\KernelInterface;
use Micro\Plugin\OAuth2\Client\OAuth2ClientPlugin;
use Micro\Plugin\OAuth2\Client\Tests\Fixture\ExampleProviderPlugin;

require_once __DIR__ . '/ExampleProviderPlugin.php';

$container = new Container();
$kernel = new Kernel([OAuth2ClientPlugin::class, ExampleProviderPlugin::class], [
    new ConfigurationProviderBootLoader([
        'MICRO_OAUTH2_PRIMARY_TYPE' => 'eXample',
        'MICRO_OAUTH2_SECONDARY_TYPE' => 'EXAMPLE',
        'MICRO_OAUTH2_MISSING_TYPE' => 'unregistered',
    ]),
    new DependencyProviderBootLoader($container),
], $container);
$container->register(KernelInterface::class, static fn () => $kernel);
$kernel->run();

return $kernel;
