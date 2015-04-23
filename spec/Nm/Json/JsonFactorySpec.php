<?php

namespace spec\Nm\Json;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonFactorySpec extends ObjectBehavior
{

    function let()
    {
        $filePath = "/home/mr/public_html/composeme/file.json";
        $this->beConstructedWith($filePath);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Nm\Json\JsonFactory');
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
        $this->beConstructedWith("");
        $this->shouldThrow("\InvalidArgumentException")->during('read');
    }

    function it_should_return_json_file_as_array()
    {
        $reader = new \Nm\Json\Reader\JsonLocal();
        $reader->read()->willReturn("{\"key\":\"value\"}");
        $this->setReader($reader);
        $this->getContent()->shouldHaveKey('key')->shouldHaveValue("value");
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
