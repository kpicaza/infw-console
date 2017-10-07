<?php

namespace InFw\Console\Listener;

use Dotenv\Dotenv;
use InFw\Console\Console;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleCommandEvent;

class EnvOptionListener
{
    const MESSAGE = 'In Framework Console tool working in %s environment.';

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

        if (class_exists(Dotenv::class)) {
            $dotenv = new Dotenv(
                $this->rootDir,
                Console::ENV === $env ? null : '.env.' . $env
            );
            $dotenv->load();
        }

        $env = $env ? $env : (getenv('APP_ENV') ? getenv('APP_ENV') : 'production');

        $this->application->setName(sprintf(self::MESSAGE, $env));
        $this->application->setVersion(getenv('APP_VERSION'));
    }
}
