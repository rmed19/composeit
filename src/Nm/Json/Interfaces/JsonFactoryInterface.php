<?php
namespace Nm\Json\Interfaces;
/**
 *
 * @author mr
 */
interface JsonFactoryInterface
{

    public function exist();

    public function read();

    public function setPath($url);
}
