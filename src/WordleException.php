<?php

namespace Wordle;

use DomainException;

final class WordleException extends DomainException
{
    public static function wordToGuessIsNotInTheList(Word $wordToGuess, WordList $wordList): self
    {
        return new self("Word $wordToGuess is not in the list of {$wordList->count()} allowed words!");
    }
}