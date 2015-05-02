<?php

namespace spec\Nm;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigFactorySpec extends ObjectBehavior
{
    function let() {
        $source = "/home/mr/composeme-config-files/knplabs/knp-paginator-bundle/config.yml";
        $distination = "app/config/config.yml";
        $this->beConstructedWith($source, $distination);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Nm\ConfigFactory');
    }
    
    function it_should_load_source_file()
    {
        $this->loadSourceFile()->shouldBeArray();
    }
    
    function it_should_load_distination_file()
    {
        $this->loadDistinationFile()->shouldBeArray();
    }
    
    function it_should_merge_source_and_distination_files()
    {
        $this->mergeConfiguration()->shouldBeArray();
    }
    
    function it_should_save_merged_file()
    {
        $this->exportConfiguration()->shouldBeBoolean();
    }
}
