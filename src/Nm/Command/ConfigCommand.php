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
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * @author Mohammed Rhamnia <mohammed.rhamnia@gmail.com>
 */
class ConfigCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
                ->setName('run')
                ->setDescription('Launch bundles configuration')
                ->setHelp(
                        <<<EOT
The <info>config</info> command reads the composer.json file from
the parent directory, processes it, and downloads and config all bundles outlined in that file.

<info>bin/composeme config</info>

EOT
                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $factory = new \Nm\ConfigLoader();
        $configFiles = $factory->configuredRepositories();

        if (count($configFiles) == 0) {
            $output->writeln("<info>No Configurable bundles founds</info>");
        } else {
            $this->beginConfiguration($input, $output, $configFiles);
        }
    }

    protected function beginConfiguration(InputInterface $input, OutputInterface $output, $configFiles)
    {
        foreach ($configFiles as $bundle => $files) {
            if (!$this->askConfirmation($output, "Did you want to configure $bundle [Y/n]?", true)) {
                continue;
            }
            foreach ($files as $source => $distination) {
                $this->configureFile($output, $bundle, $source, $distination);
            }
        }
    }

    protected function askConfirmation($output, $question, $defaultAnswer = false)
    {
        
        return $this->getDialog()->askConfirmation(
                        $output, "<question>$question</question>", $defaultAnswer
        );
    }

    protected function configureFile(OutputInterface $output, $bundle, $source, $distination)
    {
        $process = new \Nm\Process($source, $distination);
        
        if ($process->verifIfWasConfigured()) {
            if (!$this->askConfirmation($output, "Did you want to configure file $distination for bundle $bundle [Y/n]?", true)) {
                return false;
            }
        }
        $output->writeln("<comment>\tBegin config $distination file </comment>");
        
        $process->launchConfiguration($output, $this->getDialog());
    }

    protected function getDialog()
    {
        return $this->getHelperSet()->get('dialog');
    }
}
