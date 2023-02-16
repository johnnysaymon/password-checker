<?php

namespace App\Infra\Handlers;

use App\Infra\Controllers\Http\ErrorController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Factory\ResponseFactory;
use Throwable;

final class ErrorHandler
{
    private const ERROR_404 = [404, 'Resource not found'];
    private const ERROR_500 = [500, 'Internal error'];

    private int $httpStatus = 500;

    public function __construct(
        private readonly ErrorController $errorController
    ){}

    public function __invoke(
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErros,
        bool $logErrorDetails
    ): ResponseInterface
    {
        if($logErros) {
            error_log($exception->getMessage());
        }

        [$code, $message] = self::ERROR_500;

        if ($exception instanceof HttpNotFoundException) {
            $this->httpStatus = 404;
            [$code, $message] = self::ERROR_404;
        }

        $response = (new ResponseFactory())->createResponse($this->httpStatus);

        return $this->errorController
            ->setCode($code)
            ->setMessage($message)
            ->run($request, $response);
    }
}