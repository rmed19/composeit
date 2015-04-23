<?php

namespace Nm\Json;

use Nm\Json\Reader\JsonLocal;
use Nm\Json\Reader\JsonRemote;
use Seld\JsonLint;
use Nm\Json\Interfaces\JsonFactoryInterface;

class JsonFactory implements JsonFactoryInterface
{

    public $reader;

    public function __construct($filePath = "")
    {
        $this->initReader($filePath);
    }

    public function exist()
    {
        return $this->reader->exist();
    }

    public function read()
    {
        return $this->reader->read();
    }

    public function getContent()
    {
        $content = $this->reader->read();

        $parser = new JsonLint\JsonParser();
        $parser->lint($content);

        return json_decode($content, true);;
    }

    public function setReader($reader)
    {
        $this->reader = $reader;
    }

    public function getReader()
    {
        return $this->reader;
    }

    public function setPath($path)
    {
        $this->initReader($path);
    }

    public function initReader($path)
    {
        if (false === filter_var($path, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
            $this->reader = new JsonLocal($path);
        } else {
            $this->reader = new JsonRemote($path);
        }
    }

}
