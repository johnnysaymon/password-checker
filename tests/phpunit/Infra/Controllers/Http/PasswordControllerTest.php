<?php

namespace App\Tests\phpunit\Infra\Controllers\Http;

use App\Infra\Controllers\Http\PasswordController;
use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory;

final class PasswordControllerTest extends TestCase
{
    public function testVerifySuccess(): void
    {
        $requestContent = [
            'password' => 'Senha123456',
            'rules' => [
                ['rule' => 'minSize', 'value' => 6]
            ]
        ];
        $request = (new ServerRequestFactory())
            ->createServerRequest('POST', '/verify')
            ->withHeader('Content-Type', 'application/json')
            ->withParsedBody($requestContent);
        $response = (new ResponseFactory())->createResponse();
        $controller = new PasswordController();

        $response = $controller->verify($request, $response);
        $responseContent = json_decode((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($responseContent->verify);
    }

    public function testVerifyInvalid(): void
    {
        $content = [
            'password' => 'SeNha123456',
            'rules' => [
                ['rule' => 'minSize', 'value' => 6],
                ['rule' => 'minLowercase', 'value' => 4]
            ]
        ];
        $request = (new ServerRequestFactory())
            ->createServerRequest('POST', '/verify')
            ->withHeader('Content-Type', 'application/json')
            ->withParsedBody($content);
        $response = (new ResponseFactory())->createResponse();
        $controller = new PasswordController();

        $response = $controller->verify($request, $response);
        $responseContent = json_decode((string) $response->getBody());

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertFalse($responseContent->verify);
    }
}
