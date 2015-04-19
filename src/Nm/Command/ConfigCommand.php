<?php

/*
 * This file is part of ComposeMe.
 *
 * (c) Mohammed Rhamnia <mohammed.rhamnia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nm\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * @author Mohammed Rhamnia <mohammed.rhamnia@gmail.com>
 */
class ConfigCommand extends BaseCommand
{

    protected function configure()
    {
        $this
                ->setName('config')
                ->setDescription('Launch bundles configuration')
                ->setHelp(<<<EOT
The <info>config</info> command reads the composer.json file from
the parent directory, processes it, and downloads and config all bundles outlined in that file.

<info>bin/composeme config</info>

EOT
                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $factory = new \Nm\Factory();
        $configFiles = $factory->getBundlesConfig($output);
    }

}
