<?php

namespace spec\InFw\Console\Listener;

use InFw\Console\Console;
use InFw\Console\Listener\EnvOptionListener;
use PhpSpec\Exception\Exception;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EnvOptionListenerSpec extends ObjectBehavior
{
    const ENV = 'test';

    function it_should_set_up_console_env(ConsoleCommandEvent $event, Input $input)
    {
        $dir = '/tmp';
        $app = new Console(new EventDispatcher(), '/tmp');

        $input->getOption('env')->willReturn(self::ENV);
        $event->getInput()->willReturn($input);

        $this->beConstructedWith(
            $app,
            $dir
        );

        $this->__invoke($event);

        if ($app->getName() !== sprintf(EnvOptionListener::MESSAGE, self::ENV)) {
            throw new Exception(
                'Console environment not correctly set up.'
            );
        }
    }
}
