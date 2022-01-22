<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\{Input\InputInterface, Output\OutputInterface};
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class AwesomeCommand extends Command
{
    protected static $defaultName = 'my:awesome:command';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //<editor-fold desc="//...">
        /*$output->writeln('This is a <info>Info</info> text');
        $output->writeln('This is a <comment>Comment</comment> text');
        $output->writeln('This is a <question>Comment</question> text');
        $output->writeln('This is a <error>Comment</error> text');*/
        //</editor-fold>
        //<editor-fold desc="// use new style">
        /*$formatter = new OutputFormatterStyle(
            foreground: '#F0F',
            background: '#F00',
            options: [
                'blink',
            ]
        );
        $output->getFormatter()->setStyle(name: 'awesome', style: $formatter);
        $output->writeln('This is an <awesome>awesome</> style');*/
        //</editor-fold>
        // using named colors
        $output->writeln('<fg=green>foo</>');
        // using hexadecimal colors
        $output->writeln('<fg=#c0392b>foo</>');
        // black text on a cyan background
        $output->writeln('<fg=black;bg=cyan>foo</>');
        // bold text on a yellow background
        $output->writeln('<bg=yellow;options=bold>foo</>');
        // bold text with underscore
        $output->writeln('<options=bold,underscore>foo</>');

        return Command::SUCCESS;
    }
}