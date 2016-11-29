<?php

namespace App;

class Codebreaker
{
    private $code = '';
    private $guesses = [];
    private $maxNumber = 6;

    public function __construct($code = null)
    {
        if ($code && $this->codeIsValid($code)) {
            $this->code = $code;
        } else {
            $this->code = $this->generateCode();
        }
    }

    /**
     * Check a guess.
     *
     * @param  string $guess
     * @return string
     */
    public function check($guess)
    {
        if ($this->code === $guess) {
            return 'Well done!';
        }

        if (! $this->codeIsValid($guess)) {
            return 'My code only has numbers below ' . ($this->maxNumber + 1) . '!';
        }

        if ($this->isGuessedBefore($guess)) {
            return "You've already guessed $guess you silly! The result was '{$this->guesses[$guess]}'.";
        }

        $result = $this->getResult($guess);

        $this->rememberGuess($guess, $result);

        return $result;
    }

    /**
     * Determine if the code matches the guess.
     *
     * @param  string $guess
     * @return bool
     */
    private function codeIsValid($guess)
    {
        $numbersInGuess = str_split($guess);

        foreach ($numbersInGuess as $number) {
            if ((int) $number > $this->maxNumber) {
                return false;
            }
        }

        return true;
    }

    /**
     * Generate a random code.
     *
     * @return string
     */
    private function generateCode()
    {
        $code = '';

        for ($i = 1; $i <= 4; $i++) {
            $code .= mt_rand(0, $this->maxNumber);
        }

        return $code;
    }

    /**
     * Check if guess is already guessed before.
     *
     * @param  string $guess
     * @return bool
     */
    private function isGuessedBefore($guess)
    {
        return array_key_exists($guess, $this->guesses);
    }

    /**
     * Remember a Guess.
     *
     * @param  string $guess
     * @param  string $result
     */
    private function rememberGuess($guess, $result)
    {
        $this->guesses[$guess] = $result;
    }

    /**
     * getResult
     *
     * @param $guess
     * @return string
     */
    private function getResult($guess)
    {
        $numbersInCode = str_split($this->code);
        $numbersInGuess = str_split($guess);

        $result = '';

        foreach ($numbersInCode as $i => $number) {
            if ($number === $numbersInGuess[$i]) {
                $result .= '+';
            } elseif (in_array($numbersInGuess[$i], $numbersInCode)) {
                $result .= '-';
            }
        }

        return $result;
    }

    /**
     * Get the checked of guesses.
     *
     * @return array
     */
    public function guesses()
    {
        return $this->guesses;
    }
}
