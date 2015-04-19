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

    private $configuratedBundels;

    public function __construct()
    {
        $configFile = static::getConfigBundlesFile();

        $this->configuratedBundels = self::parseJson($configFile);
    }

    private static function getComposerFile()
    {
        return trim(getenv('PWD')) . '/composer.json';
    }

    private static function getConfigBundlesFile()
    {
        return __DIR__ . "/../../config-files/configs-repositories.json";
    }

    private static function parseComposerFile()
    {
        $composerFile = static::getComposerFile();

        return self::parseJson($composerFile);
    }

    public function getBundlesConfig(OutputInterface $io)
    {
        $projectBundles = self::getBundlesFromComposer();
        $configuratedBundles = $this->getBundlesCanBeConfigurated();

        $bundles = array_intersect($configuratedBundles, $projectBundles);

        $configFiles = [];

        foreach ($bundles as $bundle) {
            foreach ($this->configuratedBundels->{$bundle} as $file) {
                $configFiles[] = $bundle . "/" . $file;
            }
        }

        return $configFiles;
    }

    private static function parseJson($jsonFile)
    {
        $file = new JsonFile($jsonFile);

        return $file->read();
    }

    private function getBundlesCanBeConfigurated()
    {
        return self::getBundlesName($this->configuratedBundels);
    }

    private static function getBundlesFromComposer()
    {
        $config = self::parseComposerFile();

        $bundles = [];
        if (property_exists($config, "require")) {
            $bundles = array_merge($bundles, self::getBundlesName($config->require));
        }
        if (property_exists($config, "require-dev")) {
            $bundles = array_merge($bundles, self::getBundlesName($config->{"require-dev"}));
        }

        return $bundles;
    }

    private static function getBundlesName($object)
    {
        return array_keys(get_object_vars($object));
    }

}
