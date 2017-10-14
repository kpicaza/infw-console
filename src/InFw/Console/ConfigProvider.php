<?php

namespace InFw\Console;

use InFw\Console\Factory\ConsoleFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'console' => [
                'factories' => [

                ],
                'invokables' => [

                ],
                'helper-sets' => [

                ],
            ],
            'dependencies' => [
                'factories' => [
                    Console::class => ConsoleFactory::class
                ],
            ],
        ];
    }
}
