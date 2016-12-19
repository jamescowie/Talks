<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MeetMagento_NY_Block_SocialSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MeetMagento_NY_Block_Social');
    }
}
