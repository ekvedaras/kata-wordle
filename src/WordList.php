<?php

namespace Wordle;

class WordList
{
    /** @param Word[] $words */
    public function __construct(
        private readonly array $words,
    ) {
        if (!$this->count()) {
            throw WordListException::cannotBeEmpty();
        }
    }

    public function count(): int
    {
        return count($this->words);
    }

    public function contains(Word $word): bool
    {
        return in_array($word, $this->words);
    }
}