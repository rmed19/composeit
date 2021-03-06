<?php

namespace spec\Nm\Json\Reader;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonLocalSpec extends ObjectBehavior
{

    function let()
    {
        $filePath = "/home/mr/public_html/composeme/file.json";
        $this->beConstructedWith($filePath);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Nm\Json\Reader\JsonLocal');
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
        $this->shouldThrow(new \InvalidArgumentException("Invalide file path or file can't be read"))->during('read');
    }
}
