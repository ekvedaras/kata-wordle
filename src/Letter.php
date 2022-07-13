<?php

namespace Wordle;

use Stringable;

class Letter implements Stringable
{
    public function __construct(
        private readonly string $value,
    ) {
        if (strlen($this->value) !== 1) {
            throw LetterException::mustBeOneCharacter($this->value);
        }
    }

    public function is(Letter $letter): bool
    {
        return $this->value === $letter->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}