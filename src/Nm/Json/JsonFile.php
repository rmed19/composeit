<?php

/*
 * This file is part of ComposeMe.
 *
 * (c) Mohammed Rhamnia <mohammed.rhamnia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nm\Utils;

use Seld\JsonLint;

/**
 * Reads json files.
 *
 * @author Mohammed Rhamnia <mohammed.rhamnia@gmail.com>
 */
class JsonFile
{

    /**
     * File path 
     * 
     * @var string 
     */
    private $path;

    /**
     * Initializes json file reader.
     *
     * @param  string                    $path path to a lockfile
     */
    public function __construct($path)
    {
        $this->path = $path;
        
        
        if (false === $this->exists()) {
            throw new \InvalidArgumentException("invalide file path : {$this->path}");
        }
        
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Checks whether json file exists.
     *
     * @return bool
     */
    public function exists()
    {
        return is_file($this->path) && is_readable($this->path);
    }

    /**
     * Reads json file.
     *
     * @throws \RuntimeException
     * @return mixed
     */
    public function read()
    {
        try {
            $json = file_get_contents($this->path);
        } catch (\Exception $e) {
            throw new \RuntimeException('Could not read ' . $this->path . "\n\n" . $e->getMessage());
        }
        
        return static::parseJson($json);
    }

    /**
     * Parses json string and returns hash.
     *
     * @param string $json json string
     *
     * @return mixed
     */
    public static function parseJson($json)
    {
        $parser = new JsonLint\JsonParser();
        try {
            $parser->lint($json);
        } catch (JsonLint\ParsingException $e) {
            throw new \RuntimeException('Could not parse ' . $this->path . "\n\n" . $e->getMessage());
        }
        
        return $parser->parse($json);
    }

}
