<?php

namespace Wordle;

use DomainException;

final class WordListException extends DomainException
{
    public static function cannotBeEmpty(): self
    {
        return new self('Cannot create an empty word list');
    }
}