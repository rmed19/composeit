<?php

namespace Nm\Json\Reader;

use Seld\JsonLint;
use GuzzleHttp\Client;

class JsonRemote
{

    private $response;

    public function __construct($url)
    {
        $client = new Client();
        $request = $client->createRequest('GET', $url);
        $this->response = $client->send($request);
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

    public function getContent()
    {
        $content = $this->read();

        $parser = new JsonLint\JsonParser();
        $parser->lint($content);

        return $parser->parse($content);
    }

}
