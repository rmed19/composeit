<?php

namespace Nm\Parser\Interfaces;

/**
 *
 * @author mr
 */
interface ParserFactoryInterface
{

    public function exist();

    public function read();

    public function setPath($url);
}
