<?php

namespace Wordle;

use DomainException;

final class WordException extends DomainException
{
    public static function cannotBeEmpty(): self
    {
        return new self('A word cannot be empty');
    }

    public static function invalidLength(int $expectedLength, string $word): self
    {
        return new self("Words must be $expectedLength letter words. The length of the given word \"$word\" is " . strlen($word));
    }
}