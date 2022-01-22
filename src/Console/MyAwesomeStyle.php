<?php

declare(strict_types=1);

namespace App\Console;

use Symfony\Component\Console\Style\StyleInterface;

class MyAwesomeStyle implements StyleInterface
{
    //<editor-fold desc="Implement all methods">
    public function title(string $message)
    {
        // TODO: Implement title() method.
    }

    public function section(string $message)
    {
        // TODO: Implement section() method.
    }

    public function listing(array $elements)
    {
        // TODO: Implement listing() method.
    }

    public function text(array|string $message)
    {
        // TODO: Implement text() method.
    }

    public function success(array|string $message)
    {
        // TODO: Implement success() method.
    }

    public function error(array|string $message)
    {
        // TODO: Implement error() method.
    }

    public function warning(array|string $message)
    {
        // TODO: Implement warning() method.
    }

    public function note(array|string $message)
    {
        // TODO: Implement note() method.
    }

    public function caution(array|string $message)
    {
        // TODO: Implement caution() method.
    }

    public function table(array $headers, array $rows)
    {
        // TODO: Implement table() method.
    }

    public function ask(string $question, string $default = null, callable $validator = null): mixed
    {
        // TODO: Implement ask() method.
    }

    public function askHidden(string $question, callable $validator = null): mixed
    {
        // TODO: Implement askHidden() method.
    }

    public function confirm(string $question, bool $default = true): bool
    {
        // TODO: Implement confirm() method.
    }

    public function choice(string $question, array $choices, mixed $default = null): mixed
    {
        // TODO: Implement choice() method.
    }

    public function newLine(int $count = 1)
    {
        // TODO: Implement newLine() method.
    }

    public function progressStart(int $max = 0)
    {
        // TODO: Implement progressStart() method.
    }

    public function progressAdvance(int $step = 1)
    {
        // TODO: Implement progressAdvance() method.
    }

    public function progressFinish()
    {
        // TODO: Implement progressFinish() method.
    }
    //</editor-fold>
}