<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MyHiddenCommand extends Command
{
    protected static $defaultName = 'my:secret:command';

    protected function configure(): void
    {
        $this->setHidden(true);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Oha ! you have guessed it right');

        return Command::SUCCESS;
    }
}