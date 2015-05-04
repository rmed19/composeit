<?php

namespace Nm;

/**
 * Description of Loader
 *
 * @author mr
 */
class ConfigLoader
{

    private $reader;

    public function __construct()
    {
        $this->reader = new \Nm\Parser\ParserFactory();
    }

    public function getUsedRepositories()
    {
        $this->reader->setPath(self::getComposerFile());
        $composerContent = $this->reader->getContent();

        $bundles = [];

        if (isset($composerContent["require"])) {
            $bundles = array_merge($bundles, array_keys($composerContent["require"]));
        }
        if (isset($composerContent["require-dev"])) {
            $bundles = array_merge($bundles, array_keys($composerContent["require-dev"]));
        }

        return $bundles;
    }

    public function getConfigurableRepositories()
    {
        $this->reader->setPath(self::getConfigRemoteFile());

        return $this->reader->getContent();
    }

    public function configuredRepositories()
    {
        $composerRepositories = $this->getUsedRepositories();
        $configurableRepositories = $this->getConfigurableRepositories();
        $bundles = array_intersect(array_values($composerRepositories), array_keys($configurableRepositories));

        $configFiles = [];

        foreach ($bundles as $bundle) {
            foreach ($configurableRepositories[$bundle] as $distination => $source) {
                $configFiles[$bundle][$source] = $distination;
            }
        }

        return $configFiles;
    }

    private static function getComposerFile()
    {
        return trim(getenv('PWD')) . '/composer.json';
    }

    private static function getConfigRemoteFile()
    {
        return trim(getenv('PWD')) . '/../composeme-config-files/configs-repositories.json';
    }

}
