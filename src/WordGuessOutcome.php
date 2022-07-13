<?php

namespace Wordle;

enum WordGuessOutcome
{
    case Won;
    case TryAgain;
    case Lost;
}