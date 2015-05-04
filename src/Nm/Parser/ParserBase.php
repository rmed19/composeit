<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nm\Parser;

use Nm\Parser\Reader;

/**
 * Description of ParserBase
 *
 * @author mr
 */
class ParserBase
{

    protected $reader;

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
            $this->reader = new Reader\LocalFile($path);
        } else {
            $this->reader = new Reader\RemoteFile($path);
        }
    }

}
