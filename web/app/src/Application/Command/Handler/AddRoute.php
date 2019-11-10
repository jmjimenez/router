<?php

namespace App\Router\Application\Command\Handler;

use App\Router\Application\Command\AddRoute as AddRouteCommand;
use App\Router\Application\Repository\Router as RouterRepository;
use Exception;

class AddRoute
{
    private $routerRepository;

    public function __construct(RouterRepository $routerRepository)
    {
        $this->routerRepository = $routerRepository;
    }

    public function exec(AddRouteCommand $command): string
    {
        try {
            $router = $this->routerRepository->findOne();
            $router->addRoute($command->subnet(), $command->gateway());
            $this->routerRepository->persist($router);
            $result = 'ok';
        } catch (Exception $exception) {
            $result = sprintf('error: %s', $exception->getMessage());
        }

        return $result;
    }
}
