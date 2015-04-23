<?php

namespace Nm\Json\Reader;

use GuzzleHttp\Client;
use Nm\Json\Interfaces\JsonFactoryInterface;

class JsonRemote implements JsonFactoryInterface
{

    private $response;

    public function __construct($url = null)
    {
        if (isset($url)) {
            $this->initResponse($url);
        }
    }

    public function exist()
    {
        return (bool) ($this->response->getStatusCode() == 200);
    }

    public function read()
    {
        if (false === $this->exist()) {
            throw new \InvalidArgumentException("Invalide file path or file can't be read");
        }
        $body = $this->response->getBody()->getContents();
        return $body;
    }

    public function setPath($url)
    {
        $this->initResponse($url);
    }

    public function initResponse($url)
    {
        $client = new Client();
        $request = $client->createRequest('GET', $url);
        $this->response = $client->send($request);
    }

}
