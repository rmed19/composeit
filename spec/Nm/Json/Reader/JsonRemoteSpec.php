<?php

namespace spec\Nm\Json\Reader;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonRemoteSpec extends ObjectBehavior
{
    function let()
    {
        $filePath = "http://localhost/~mr/composeme/file.json";
        $this->beConstructedWith($filePath);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Nm\Json\Reader\JsonRemote');
    }

    function it_should_test_if_file_exist()
    {
        $this->exist()->shouldBeBoolean();
    }

    function it_should_get_file_content()
    {
        $this->read()->shouldBeString();
    }

    function it_should_throw_exception_if_file_doesnt_exist()
    {
        $this->beConstructedWith("http://aaaaa.cd");
        $this->shouldThrow("\GuzzleHttp\Exception\ConnectException");
    }

    function it_should_return_json_file_as_array()
    {
        $this->getContent()->shouldHaveKey('require-dev');
    }

    public function getMatchers()
    {
        return [
            'haveKey' => function ($subject, $key) {
                return array_key_exists($key, $subject);
            },
            'haveValue' => function ($subject, $value) {
                return in_array($value, $subject);
            },
        ];
    }
}
