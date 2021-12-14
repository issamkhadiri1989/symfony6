<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Finder\Finder;

class ImageFileManager extends AbstractFileManager
{
    public function scan(string $dirPath): array
    {
        $finder = new Finder();
        $finder->files()->in($dirPath)->name('/\.png/');

        return $this->readFinder($finder);
    }

    public function scanByContent(string $dirPath, string $content): array
    {
        $finder = new Finder();
        $finder->files()
            ->in($dirPath)
            ->name('/\.png/')
            ->contains($content);

        return $this->readFinder($finder);
    }
}