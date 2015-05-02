<?php

namespace Nm;

class ParserFactory
{

    private $jsonReader;

    public function __construct(Json\JsonFactory $jsonFactory)
    {
        $this->jsonReader = $jsonFactory;
    }

    public function getUsedRepositories()
    {
        $this->jsonReader->setPath(self::getComposerFile());
        $composerContent = $this->jsonReader->getContent();

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
        $this->jsonReader->setPath(self::getConfigRemoteFile());

        return $this->jsonReader->getContent();
    }

    public function configuredRepositories()
    {
        $composerRepositories = $this->getUsedRepositories();
        $configurableRepositories = $this->getConfigurableRepositories();
        
        $bundles = array_intersect(array_values($composerRepositories), array_keys($configurableRepositories));

        $configFiles = [];

        foreach ($bundles as $bundle) {
            foreach ($configurableRepositories[$bundle] as $file) {
                $configFiles[$bundle][] = $file;
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
