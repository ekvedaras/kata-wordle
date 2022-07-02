<?php

namespace Wordle;

use SplFileInfo;

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

    public static function fromFile(SplFileInfo $file): static
    {
        $handle = $file->openFile();

        $words = [];
        while (!$handle->eof()) {
            $words[] = new Word(trim($handle->getCurrentLine()));
            $handle->next();
        }

        return new static(array_unique($words));
    }

    public function count(): int
    {
        return count($this->words);
    }

    public function contains(Word $word): bool
    {
        return in_array($word, $this->words);
    }

    public function with(Word $word): static
    {
        if ($this->contains($word)) {
            return $this;
        }

        return new static(array_unique([...$this->words, $word]));
    }
}