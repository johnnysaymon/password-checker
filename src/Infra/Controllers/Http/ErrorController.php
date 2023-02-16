<?php

namespace App\Infra\Controllers\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ErrorController
{
    private int $code;
    private string $message;

    public function __construct()
    {
        $this->code = 1;
        $this->message = 'Unknown';
    }

    public function run(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write(
            json_encode([
                'code' => $this->code,
                'message' => $this->message
            ])
        );

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;
        return $this;
    }
}