<?php

namespace Wordle;

use PHPUnit\Framework\TestCase;
use SplFileInfo;

class WordleTest extends TestCase
{
    public function test_demo(): void
    {
        $wordToGuess = new Word('women');
        $game = new Wordle(
            WordList::fromFile(new SplFileInfo(__DIR__ . '/../words.txt')),
            $wordToGuess,
        );

        $this->assertSame(WordGuessOutcome::TryAgain, $game->guess(new Word('okays')));
        $this->assertSame(WordGuessOutcome::Won, $game->guess(new Word('women')));

        $firstGuess = $game->guesses()[0];
        $secondGuess = $game->guesses()[1];

        $this->assertTrue($firstGuess->equals(new Guess(new Word('okays'), $wordToGuess)));
        $this->assertTrue($secondGuess->equals(new Guess(new Word('women'), $wordToGuess)));

        $this->assertEquals(LetterGuessOutcome::IncorrectPlacement, $firstGuess->letterOutcomes['o']);
        $this->assertEquals(LetterGuessOutcome::NotInTheWord, $firstGuess->letterOutcomes['k']);
        $this->assertEquals(LetterGuessOutcome::NotInTheWord, $firstGuess->letterOutcomes['a']);
        $this->assertEquals(LetterGuessOutcome::NotInTheWord, $firstGuess->letterOutcomes['y']);
        $this->assertEquals(LetterGuessOutcome::NotInTheWord, $firstGuess->letterOutcomes['s']);

        $this->assertEquals(LetterGuessOutcome::CorrectPlacement, $secondGuess->letterOutcomes['w']);
        $this->assertEquals(LetterGuessOutcome::CorrectPlacement, $secondGuess->letterOutcomes['o']);
        $this->assertEquals(LetterGuessOutcome::CorrectPlacement, $secondGuess->letterOutcomes['m']);
        $this->assertEquals(LetterGuessOutcome::CorrectPlacement, $secondGuess->letterOutcomes['e']);
        $this->assertEquals(LetterGuessOutcome::CorrectPlacement, $secondGuess->letterOutcomes['n']);
    }
}
