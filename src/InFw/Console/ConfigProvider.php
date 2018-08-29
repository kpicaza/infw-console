<?php

namespace InFw\Console;

use InFw\Console\Factory\ConsoleFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'console' => [
                'helper-sets' => [

                ],
            ],
        ];
    }
}
