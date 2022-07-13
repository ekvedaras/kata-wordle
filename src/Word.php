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

    /** @return Letter[] */
    public function letters(): array
    {
        return array_map(fn(string $letter) => new Letter($letter), str_split($this->word));
    }

    public function letter(int $at): Letter
    {
        return new Letter($this->word[$at]);
    }

    public function contains(Letter $letter): bool
    {
        return str_contains($this->word, $letter);
    }
}