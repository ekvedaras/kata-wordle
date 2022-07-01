<?php

namespace Wordle;

class Wordle
{
    public function __construct(
        private readonly WordList $wordList,
        private readonly Word $wordToGuess,
    ) {
        if (!$this->wordList->contains($this->wordToGuess)) {
            throw WordleException::wordToGuessIsNotInTheList($this->wordToGuess, $this->wordList);
        }
    }
}