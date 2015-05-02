<?php

/*
 * This file is part of ComposeMe.
 *
 * (c) Mohammed Rhamnia <mohammed.rhamnia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nm\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;

use Nm\Command;

/**
 * The console application that handles the commands
 *
 * @author Mohammed Rhamnia <mohammed.rhamnia@gmail.com>
 */
class NmApplication extends BaseApplication
{

    const VERSION = '0.1-alpha';

    public function __construct()
    {
        if (function_exists('ini_set') && extension_loaded('xdebug')) {
            ini_set('xdebug.show_exception_trace', false);
            ini_set('xdebug.scream', false);
        }
        
        parent::__construct('composeme', self::VERSION);
    }
    
    /**
     * Initializes all the composeme commands
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        $commands[] = new Command\AboutCommand();
        $commands[] = new Command\ConfigCommand();
        
        return $commands;
    }

}
