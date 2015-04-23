<?php

namespace spec\Nm;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigFactorySpec extends ObjectBehavior
{

    function let(\Nm\Json\JsonFactory $jsonFactory)
    {
        $json->getContent()->willReturn(
                ["knplabs/knp-paginator-bundle" => [
                        "config.yml" => "https://raw.githubusercontent.com/rmed19/composeme-config-files/master/knplabs/knp-paginator-bundle/config.yml"
        ]]);
        
        $this->beConstructedWith($jsonFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Nm\ConfigFactory');
    }

    function it_find_used_repositories()
    {
        $this->getUsedRepositories()->shouldBeAnArray();
    }

    function it_should_return_configurable_repositories()
    {
        $this->getConfigurableRepositories()->shouldBeArray();
    }

    function it_should_configure_project_files()
    {
        $this->configureRepositories()->shouldBeArray();
    }

}
