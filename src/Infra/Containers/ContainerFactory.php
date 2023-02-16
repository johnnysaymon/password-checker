<?php

declare(strict_types=1);

namespace App\Infra\Containers;

use DI\ContainerBuilder;
use Exception;
use Psr\Container\ContainerInterface;

final class ContainerFactory
{
    /**
     * @throws Exception
     */
    public function create(): ContainerInterface
    {
        $containerBuilder = new ContainerBuilder();
        return $containerBuilder->build();
    }
}