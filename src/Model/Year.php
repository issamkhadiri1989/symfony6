<?php

declare(strict_types=1);

namespace App\Model;

class Year
{
    /**
     * Generates the 20 century.
     *
     * @return array<int> The set of years
     */
    public static function yearsOf20Century(): array
    {
        return \range(1900, 2000);
    }
}
