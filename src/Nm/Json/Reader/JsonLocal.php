<?php

namespace Nm\Json\Reader;

use Seld\JsonLint;

class JsonLocal
{

    private $path;

    public function __construct($filePath = "")
    {
        $this->path = $filePath;
    }

    public function exist()
    {
        return (bool) (is_file($this->path) & is_readable($this->path));
    }

    public function read()
    {
        if (false === $this->exist()) {
            throw new \InvalidArgumentException("Invalide file path or file can't be read");
        }
        
        return file_get_contents($this->path);
    }
    
    public function getContent()
    {
        $content = $this->read();
        
        $parser = new JsonLint\JsonParser();
        $parser->lint($content);

        return $parser->parse($content);
    }
}
