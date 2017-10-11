<?php

namespace InFw\Console;

use InFw\Console\Config\LoadCommands;
use InFw\Console\Listener\EnvOptionListener;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Console extends Application
{
    const ENV = 'local';

    public function __construct(EventDispatcher $dispatcher, $path, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->setDispatcher($dispatcher);
        $this->setEnv();
        $dispatcher->addListener(ConsoleEvents::COMMAND, new EnvOptionListener(
            $this,
            realpath($path)
        ), 1000);

        (new LoadCommands($this))();
    }

    public function setEnv(string $env = self::ENV)
    {
        $this->getDefinition()->addOptions([
            new InputOption(
                'env',
                '-e',
                InputOption::VALUE_OPTIONAL,
                '',
                $env
            ),
        ]);
    }
}
