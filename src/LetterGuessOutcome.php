<?php

namespace Wordle;

enum LetterGuessOutcome
{
    case CorrectPlacement;
    case IncorrectPlacement;
    case NotInTheWord;
}
