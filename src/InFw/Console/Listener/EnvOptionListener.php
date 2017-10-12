<?php

namespace InFw\Console\Listener;

use Dotenv\Dotenv;
use InFw\Console\Console;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleCommandEvent;

class EnvOptionListener
{
    const MESSAGE = '<info>     ___         _____                                            _    
    |_ _|_ __   |  ___| __ __ _ _ __ ___   _____      _____  _ __| | __
     | || \'_ \  | |_ | \'__/ _` | \'_ ` _ \ / _ \ \ /\ / / _ \| \'__| |/ /
     | || | | | |  _|| | | (_| | | | | | |  __/\ V  V / (_) | |  |   < 
    |___|_| |_| |_|  |_|  \__,_|_| |_| |_|\___| \_/\_/ \___/|_|  |_|\_\
                                                                        
    Working in %s environment.</info>';

    protected $application;
    protected $rootDir;

    public function __construct(Application $application, string $rootDir)
    {
        $this->application = $application;
        $this->rootDir = $rootDir;
    }

    public function __invoke(ConsoleCommandEvent $event)
    {
        $input = $event->getInput();
        $env = $input->getOption('env');
        $hasEnv = Console::ENV === $env;

        $envFileName = '.env' . ($hasEnv ? '' : '.' . $env);

        if (
            class_exists(Dotenv::class)
            && file_exists($this->rootDir . $envFileName)
        ) {
            $dotenv = new Dotenv($this->rootDir, $hasEnv ? null : '.env.' . $env);
            $dotenv->load();
        }

        $env = $env ? $env : (getenv('APP_ENV') ? getenv('APP_ENV') : 'production');

        $this->application->setName(sprintf(self::MESSAGE, $env));
        $this->application->setVersion(getenv('APP_VERSION'));
    }
}
