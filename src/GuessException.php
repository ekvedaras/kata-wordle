<?php

namespace Wordle;

use DomainException;

final class GuessException extends DomainException
{
    public static function alreadyGuessed(Word $guess): self
    {
        return new self("Word $guess was already guessed. Try another one.");
    }

    public static function noSuchWord(Word $word): self
    {
        return new self("Word $word is not on the list. Try another one.");
    }
}