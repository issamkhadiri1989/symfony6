<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Finder\Finder;

class PhpFileManager extends AbstractFileManager
{
    public function scan(string $dirPath): array
    {
        $finder = new Finder();
        $finder->files()->in($dirPath)->name('/\.php$/');

        return $this->readFinder($finder);
    }

    public function scanByContent(string $dirPath, string $content): array
    {
        $finder = new Finder();
        $finder->files()
            ->in($dirPath)
            ->name('/\.php$/')
            ->contains($content);

        return $this->readFinder($finder);
    }
}
