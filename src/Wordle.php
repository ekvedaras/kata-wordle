<?php

namespace Wordle;

class Wordle
{
    public const WordLength = 5;
    public const MaxAttempts = 6;

    /** @var Guess[] */
    private array $guesses = [];

    public function __construct(
        private readonly WordList $wordList,
        private readonly Word $wordToGuess,
    ) {
        if (!$this->wordList->contains($this->wordToGuess)) {
            throw WordleException::wordToGuessIsNotInTheList($this->wordToGuess, $this->wordList);
        }
    }

    public function guess(Word $word): WordGuessOutcome
    {
        $guess = new Guess(
            word:        $word,
            wordToGuess: $this->wordToGuess,
        );

        if (!$this->wordList->contains($word)) {
            throw GuessException::noSuchWord($word);
        }

        if (in_array($guess, $this->guesses)) {
            throw GuessException::alreadyGuessed($word);
        }

        $this->guesses[] = $guess;

        if ($this->wordToGuess->equals($word)) {
            return WordGuessOutcome::Won;
        }

        if (count($this->guesses) >= self::MaxAttempts) {
            return WordGuessOutcome::Lost;
        }

        return WordGuessOutcome::TryAgain;
    }

    /** @return Guess[] */
    public function guesses(): array
    {
        return $this->guesses;
    }
}