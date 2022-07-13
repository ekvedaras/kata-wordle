<?php

namespace Wordle;

class Guess
{
    /** @var array<Letter, LetterGuessOutcome> */
    public readonly array $letterOutcomes;

    public function __construct(
        public readonly Word $word,
        private readonly Word $wordToGuess,
    ) {
        $this->letterOutcomes = array_combine(
            array_map(strval(...), $this->word->letters()),
            array_map(
                fn(Letter $guessedLetter, int $guessedLocation) => match (true) {
                    $this->wordToGuess->letter(at: $guessedLocation)->is($guessedLetter) => LetterGuessOutcome::CorrectPlacement,
                    $this->wordToGuess->contains($guessedLetter) => LetterGuessOutcome::IncorrectPlacement,
                    default => LetterGuessOutcome::NotInTheWord,
                },
                $this->word->letters(),
                range(0, Wordle::WordLength - 1),
            )
        );
    }

    public function equals(Guess $that): bool
    {
        return $this->word->equals($that->word) && $this->wordToGuess->equals($that->wordToGuess);
    }
}