<?php

namespace spec\App;

use App\Codebreaker;
use App\InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CodebreakerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('0123');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Codebreaker::class);
    }

    function it_validates_the_guess()
    {
        $this->shouldThrow(
            new InvalidArgumentException('My code only has numbers below 7!')
        )->duringCheck('4557');
    }

    function it_matches_correct_for_no_matches()
    {
        $this->check('4554')->shouldReturn('');
    }

    function it_matches_numbers_at_the_wrong_position()
    {
        $this->check('3256')->shouldReturn('--');
    }

    function it_matches_numbers_at_the_correct_position()
    {
        $this->check('0654')->shouldReturn('+');
    }

    function it_matches_a_correct_code()
    {
        $this->check('0123')->shouldReturn('Well done!');
    }

    function it_matches_a_0654_guess_correctly()
    {
        $this->check('0654')->shouldReturn('+');
    }

    function it_matches_a_1054_guess_correctly()
    {
        $this->check('1053')->shouldReturn('--+');
    }

    function it_matches_a_0325_guess_correctly()
    {
        $this->check('0025')->shouldReturn('+-+');
    }

    function it_matches_a_1023_guess_correctly()
    {
        $this->check('1023')->shouldReturn('--++');
    }

    function it_remembers_guesses()
    {
        $this->check('2424');
        $this->check('2424')->shouldReturn("You've already guessed 2424 you silly! The result was '-+'.");
    }

    function it_provides_the_history_of_guesses()
    {
        $this->check('4554');
        $this->check('3025');
        $this->check('0132');
        $this->guesses()->shouldReturn([
            '4554' => '',
            '3025' => '--+',
            '0132' => '++--',
        ]);
    }
}
