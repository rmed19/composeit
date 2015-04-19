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
class AboutCommand extends BaseCommand
{
    protected function configure()
    {
        $this
                ->setName('about')
                ->setDescription('Short information about Compose Me')
                ->setHelp(<<<EOT
<info>bin/composeme about</info>
EOT
                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(<<<EOT
<info>ComposeMe - Configuration System for Symfony Bundles</info>
<comment>ComposeMe is a configuration systmee to easy configre Symfony Bundles.
See http://github.org/rmed19/composeme for more information.</comment>
EOT
        );
    }
}
