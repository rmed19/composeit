<?php

namespace Nm\Parser\Yml;

use Nm\Parser\Interfaces\ParserFactoryInterface;
use Nm\Parser\ParserBase;

use Symfony\Component\Yaml\Yaml;

class YmlFactory extends ParserBase implements ParserFactoryInterface
{

    public function getContent()
    {
        $content = $this->reader->read();

        return Yaml::parse($content);
    }

}
