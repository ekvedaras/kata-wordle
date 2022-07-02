<?php

namespace Wordle;

use PHPUnit\Framework\TestCase;
use SplFileInfo;

class WordleTest extends TestCase
{
    public function test_demo(): void
    {
        $game = new Wordle(
            WordList::fromFile(new SplFileInfo(__DIR__ . '/../words.txt')),
            new Word('women'),
        );

        $this->assertSame(GuessOutcome::TryAgain, $game->guess(new Word('okays')));
        $this->assertSame(GuessOutcome::Won, $game->guess(new Word('women')));

        $this->assertEquals(
            new WordList([
                             new Word('okays'),
                             new Word('women'),
                         ]),
            $game->guesses()
        );
    }
}
