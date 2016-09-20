<?php

namespace spec\App;

use App\Calculator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Calculator::class);
    }

    function it_should_sum()
    {
        $this->sum(4, 7);
        $this->result()->shouldBe(11);
    }
}
