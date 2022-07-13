<?php

namespace Wordle;

use DomainException;

final class LetterException extends DomainException
{
    public static function mustBeOneCharacter(string $given): self
    {
        return new self("Letters must be one character. $given given.");
    }
}