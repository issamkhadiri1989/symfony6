<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Finder\Finder;

abstract class AbstractFileManager
{
    /**
     * Scans the given path and retrieves all php files.
     *
     * @param string $dirPath the directory where to find files
     *
     * @return string[] the set of files if found or empty array if none found
     */
    abstract public function scan(string $dirPath): array;

    /**
     * Retrieves files in the given directory by the content.
     *
     * @param string $dirPath The directory path
     * @param string $content The search based content
     *
     * @return string[] The list of files that match the rules
     */
    abstract public function scanByContent(string $dirPath, string $content): array;

    /**
     * Iterates and reads data form the Finder instance and returns data
     * in an array.
     *
     * @param Finder $finder the current Finder instance
     *
     * @return string[] the set of files in Finder data
     */
    protected function readFinder(Finder $finder): array
    {
        if ($finder->hasResults() === false) {
            return [];
        }

        $output = [];
        foreach ($finder as $file) {
            $output[] = $file->getRealPath();
        }

        return $output;
    }
}