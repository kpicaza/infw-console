<?php

namespace InFw\Console\Config;

//use InFw\Generator\Command\CreateUseCase;
use Symfony\Component\Console\Application;

class LoadCommands
{
    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function __invoke()
    {
        $this->application->addCommands([
//           new CreateUseCase()
        ]);
    }
}
