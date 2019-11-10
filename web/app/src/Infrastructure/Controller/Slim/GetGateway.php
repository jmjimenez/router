<?php

namespace App\Router\Infrastructure\Controller\Slim;

use App\Router\Infrastructure\Repository\Router as RouterRepository;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Router\Application\Command\GetGateway as GetGatewayCommand;
use App\Router\Application\Command\Handler\GetGateway as GetGatewayCommandHandler;

class GetGateway
{
    public function handle(Request $request, Response $response)
    {
        $params = $request->getQueryParams();
        $ip = isset($params['ip']) ? $params['ip'] : null;

        try {
            $command = new GetGatewayCommand($ip);
            $commandHandler = new GetGatewayCommandHandler(new RouterRepository());
            $result = $commandHandler->exec($command);
        } catch (Exception $exception) {
            $result = $exception->getMessage();
        }
        $response->getBody()->write($result);
    }
}
