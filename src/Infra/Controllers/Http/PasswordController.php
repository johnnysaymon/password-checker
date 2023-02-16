<?php

namespace App\Infra\Controllers\Http;

use App\Domain\Models\Password\PasswordFactory;
use Exception;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class PasswordController
{
    private ServerRequestInterface $request;

    /**
     * @throws Exception
     */
    public function verify(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $this->request = $request;

        $data = $this->extractData();
        $password = PasswordFactory::create($data['password'], $data['rules']);

        $passwordStatus = $password->verify();

        $responseBody = [
            'verify' => $passwordStatus,
            'noMatch' => $password->getErros()
        ];

        $response->getBody()->write(json_encode($responseBody));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($passwordStatus ? 200 : 422);
    }

    /**
     * @throws Exception
     */
    private function extractData(): array
    {
        $data = $this->request->getParsedBody();

        if(! (is_array($data) && isset($data['password']) && is_array($data['rules']))) {
            throw new Exception('Invalid data');
        }

        return $data;
    }
}
