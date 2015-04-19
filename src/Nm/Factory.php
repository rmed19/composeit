<?php

/*
 * This file is part of ComposeMe.
 *
 * (c) Mohammed Rhamnia <mohammed.rhamnia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nm;

use Symfony\Component\Console\Output\OutputInterface;
use Nm\Utils\JsonFile;

/**
 * Description of Factory
 *
 * @author mr
 */
class Factory
{

    private static function getComposerFile()
    {
        return trim(getenv('PWD')) . '/composer.json';
    }

    private static function parseComposerFile(OutputInterface $io)
    {
        $composerFile = static::getComposerFile();
        
        $file = new JsonFile($composerFile);
        
        return $file->read();
    }

    public function getBundles(OutputInterface $io)
    {
        $config = self::parseComposerFile($io);
        $bundles = [];
        if(property_exists($config, "require")) {
            $bundles = array_merge($bundles, $this->getBundlesFromJson($config->require));
        }
        if(property_exists($config, "require-dev")) {
            $bundles = array_merge($bundles, $this->getBundlesFromJson($config->{"require-dev"}));
        }
        
        var_dump($bundles);
        die;
    }
    
    private function getBundlesFromJson($object)
    {
        return array_keys(get_object_vars($object));
    }

}
