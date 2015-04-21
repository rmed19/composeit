<?php

namespace Nm\Json;

use Nm\Json\Reader\JsonLocal;
use Nm\Json\Reader\JsonRemote;

class JsonFactory
{
    protected $reader;
    
    public function __construct($filePath = "")
    {
        if(false === filter_var($filePath, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
            $this->reader = new JsonLocal();
        } else {
            $this->reader = new JsonRemote();
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
}
