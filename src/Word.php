<?php

namespace Wordle;

use Stringable;

class Word implements Stringable
{
    private readonly string $word;

    public function __construct(string $word)
    {
        if (empty($word)) {
            throw WordException::cannotBeEmpty();
        }

        if (strlen($word) !== Wordle::WordLength) {
            throw WordException::invalidLength(
                expectedLength: Wordle::WordLength,
                word:           $word,
            );
        }

        $this->word = strtolower($word);
    }

    public function __toString(): string
    {
        return $this->word;
    }

    public function equals(Word $word): bool
    {
        return $this->word === $word->word;
    }
}