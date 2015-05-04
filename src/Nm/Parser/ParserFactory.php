<?php

namespace Nm\Parser;

use Nm\Parser;

class ParserFactory implements Interfaces\ParserFactoryInterface
{

    private $reader;

    public function __construct($filePath = null)
    {
        if ($filePath) {
            $this->reader = $this->initReader($filePath);
        }
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
        return $this->reader->getContent();
    }

    public function setPath($path)
    {
        $this->reader = $this->initReader($path);
    }

    public function initReader($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        switch (strtolower($ext)) {
            case 'json':
                return new Parser\Json\JsonFactory($path);
            case 'xml':
                return new Parser\Xml\XmlFactory($path);
            case 'yml':
                return new Parser\Yml\YmlFactory($path);
            default:
                throw new \Exception("Unkown File extension : $ext");
        }
    }
}
