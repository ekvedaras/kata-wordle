<?php

namespace Wordle;

class Wordle
{
    public const WordLength = 5;
    public const MaxAttempts = 6;

    private ?WordList $guesses;

    public function __construct(
        private readonly WordList $wordList,
        private readonly Word $wordToGuess,
    ) {
        if (!$this->wordList->contains($this->wordToGuess)) {
            throw WordleException::wordToGuessIsNotInTheList($this->wordToGuess, $this->wordList);
        }
    }

    public function guess(Word $word): GuessOutcome
    {
        $this->guesses ??= new WordList([$word]);
        $this->guesses = $this->guesses->with($word);

        if ($this->wordToGuess->equals($word)) {
            return GuessOutcome::Won;
        }

        if ($this->guesses->count() >= self::MaxAttempts) {
            return GuessOutcome::Lost;
        }

        return GuessOutcome::TryAgain;
    }

    public function guesses(): WordList
    {
        return $this->guesses;
    }
}