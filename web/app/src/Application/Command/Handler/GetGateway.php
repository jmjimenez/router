<?php

namespace App\Router\Application\Command\Handler;

use App\Router\Application\Command\GetGateway as GetGatewayCommand;
use App\Router\Application\Repository\Router as RouterRepository;
use Exception;

class GetGateway
{
    private $routerRepository;

    public function __construct(RouterRepository $routerRepository)
    {
        $this->routerRepository = $routerRepository;
    }

    public function exec(GetGatewayCommand $command): string
    {
        try {
            $router = $this->routerRepository->findOne();
            $result = $router->getGatewayForIpAddress($command->ipAddress()) ?? 'error: not found';
        } catch (Exception $exception) {
            $result = sprintf('error: %s', $exception->getMessage());
        }

        return $result;
    }
}
