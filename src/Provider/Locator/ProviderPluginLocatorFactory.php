<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Micro\Plugin\OAuth2\Client\Provider\Locator;

use Micro\Framework\Kernel\KernelInterface;
use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ProviderPluginLocatorFactory implements ProviderPluginLocatorFactoryInterface
{
    /**
     * @param KernelInterface $kernel
     */
    public function __construct(
        private readonly KernelInterface $kernel
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ProviderPluginLocatorInterface
    {
        return new ProviderPluginLocator(
            $this->kernel,
        );
    }
}