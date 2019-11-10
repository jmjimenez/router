<?php

namespace App\Router\Infrastructure\Repository;

use App\Router\Domain\Aggregate\Router as RouterAggregate;
use Fuz\Component\SharedMemory\SharedMemory;
use Fuz\Component\SharedMemory\Storage\StorageFile;

class Router implements \App\Router\Application\Repository\Router
{
    public function persist(RouterAggregate $router)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $this->getShared()->router = $router;
    }

    public function findOne(): RouterAggregate
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $router = $this->getShared()->router;

        if (!$router instanceof RouterAggregate) {
            $router = new RouterAggregate();
            /** @noinspection PhpUndefinedFieldInspection */
            $this->getShared()->router = $router;
        }
        return $router;
    }

    private function getShared(): SharedMemory
    {
        $storage = new StorageFile('/tmp/router.tmp');
        $shared = new SharedMemory($storage);

        return $shared;
    }
}
