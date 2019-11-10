<?php

namespace App\Router\Application\Repository;

use App\Router\Domain\Aggregate\Router as RouterAggregate;

interface Router
{
    public function persist(RouterAggregate $router);
    public function findOne(): RouterAggregate;
}
