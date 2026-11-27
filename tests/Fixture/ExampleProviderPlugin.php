<?php

declare(strict_types=1);

namespace Micro\Plugin\OAuth2\Client\Tests\Fixture;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\GenericProvider;
use Micro\Plugin\OAuth2\Client\Provider\OAuth2ClientProviderPluginInterface;

final class ExampleProviderPlugin implements OAuth2ClientProviderPluginInterface
{
    public function getType(): string
    {
        return 'Example';
    }

    public function createProvider(string $providerName): AbstractProvider
    {
        $baseUrl = 'https://identity.example/' . $providerName;

        return new GenericProvider([
            'urlAuthorize' => $baseUrl . '/authorize',
            'urlAccessToken' => $baseUrl . '/token',
            'urlResourceOwnerDetails' => $baseUrl . '/userinfo',
        ]);
    }
}
