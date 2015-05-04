<?php

namespace Nm\Parser\Json;

use Nm\Parser\Interfaces\ParserFactoryInterface;
use Nm\Parser\ParserBase;

use Seld\JsonLint;

class JsonFactory extends ParserBase implements ParserFactoryInterface
{
    public function getContent()
    {
        $content = $this->reader->read();

        $parser = new JsonLint\JsonParser();
        $parser->lint($content);

        return json_decode($content, true);
    }
}
