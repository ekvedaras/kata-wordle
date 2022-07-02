<?php

namespace Wordle;

enum GuessOutcome
{
    case Won;
    case TryAgain;
    case Lost;
}