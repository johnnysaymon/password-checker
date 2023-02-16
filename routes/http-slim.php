<?php

declare(strict_types=1);

$app = (new \App\Infra\Routers\SlimFactory())->create();

$app->addRoutingMiddleware();

$app->addErrorMiddleware(false, true, true)
    ->setDefaultErrorHandler(\App\Infra\Handlers\ErrorHandler::class);

$app->post('/verify', [\App\Infra\Controllers\Http\PasswordController::class, 'verify']);

$app->run();