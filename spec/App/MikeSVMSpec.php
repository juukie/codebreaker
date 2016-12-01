<?php

namespace spec\App;

use App\MikeSVM;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MikeSVMSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MikeSVM::class);
    }

    function it_can_greet()
    {
        $this->sayHi()->shouldReturn('Hi!');
    }
}
