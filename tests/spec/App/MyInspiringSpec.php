<?php

namespace spec\App;

use App\MyInspiring;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class MyInspiringSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MyInspiring::class);
    }
}
