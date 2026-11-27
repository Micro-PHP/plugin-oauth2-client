<?php

declare(strict_types=1);

namespace Micro\Plugin\OAuth2\Client\Tests;

use Micro\Plugin\OAuth2\Client\Exception\ProviderAdapterNotRegisteredException;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;
use PHPUnit\Framework\TestCase;

final class OAuth2ClientPluginTest extends TestCase
{
    private Oauth2ClientFacadeInterface $facade;

    protected function setUp(): void
    {
        $kernel = require __DIR__ . '/Fixture/application.php';
        $this->facade = $kernel->container()->get(Oauth2ClientFacadeInterface::class);
    }

    public function testSelectsTheAdapterCaseInsensitivelyAndCachesByName(): void
    {
        $primary = $this->facade->getProvider('primary');
        self::assertSame('https://identity.example/primary/authorize', $primary->getBaseAuthorizationUrl());
        self::assertSame($primary, $this->facade->getProvider('primary'));

        $secondary = $this->facade->getProvider('secondary');
        self::assertNotSame($primary, $secondary);
        self::assertSame('https://identity.example/secondary/authorize', $secondary->getBaseAuthorizationUrl());
    }

    public function testReportsTheUnregisteredProviderType(): void
    {
        $this->expectException(ProviderAdapterNotRegisteredException::class);
        $this->expectExceptionMessage('OAuth2 provider "unregistered" is not registered.');

        $this->facade->getProvider('missing');
    }
}
