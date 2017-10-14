<?php

namespace InFw\Console\Factory;

use InFw\Console\Console;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ConsoleFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $rootDir = $container->get('config')['root_dir'];

        return new Console(new EventDispatcher(), $rootDir);
    }
}
