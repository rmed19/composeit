<?php

namespace Nm;

class ConfigFactory
{
    private $sourceFile;
    private $distinationFile;
    private $sourceData;
    private $distinationData;
    
    public function __construct($source, $distination)
    {
        $this->sourceFile = $source;
        $this->distinationFile = $distination;
    }

    public function loadSourceFile()
    {
        $parser = new Nm\ParserFactory($this->sourceFile);
        $this->sourceData = $parser->loadData();
    }

    public function loadDistinationFile()
    {
        $parser = new Nm\ParserFactory($this->distinationData);
        $this->distinationData = $parser->loadData();
    }

    public function mergeConfiguration()
    {
        // TODO: write logic here
    }

    public function exportConfiguration()
    {
        // TODO: write logic here
    }

    public function execute()
    {

    }
}
