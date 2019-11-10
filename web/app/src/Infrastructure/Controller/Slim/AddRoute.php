<?php

namespace App\Router\Infrastructure\Controller\Slim;

use App\Router\Infrastructure\Repository\Router as RouterRepository;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Router\Application\Command\AddRoute as AddRouteCommand;
use App\Router\Application\Command\Handler\AddRoute as AddRouteCommandHandler;

class AddRoute
{
    public function handle(Request $request, Response $response)
    {
        $params = $request->getQueryParams();
        $ip = isset($params['ip']) ? $params['ip'] : null;
        $netmask = isset($params['netmask']) ? $params['netmask'] : null;
        $gateway = isset($params['gateway']) ? $params['gateway'] : null;

        try {
            $command = new AddRouteCommand($ip, $netmask, $gateway);
            $commandHandler = new AddRouteCommandHandler(new RouterRepository());
            $result = $commandHandler->exec($command);
        } catch (Exception $exception) {
            $result = $exception->getMessage();
        }
        $response->getBody()->write($result);
    }
}
