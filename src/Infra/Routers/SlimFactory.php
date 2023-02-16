<?php

namespace App\Infra\Routers;

use App\Infra\Containers\ContainerFactory;
use Slim\App;
use Slim\Factory\AppFactory;

final class SlimFactory
{
    public function create(): App
    {
        try {
            $container = (new ContainerFactory())->create();
            AppFactory::setContainer($container);
            $app = AppFactory::create();
        } catch (\Exception $e) {
            die('Rota ou controle não pode ser criada');
        }

        return $app;
    }
}