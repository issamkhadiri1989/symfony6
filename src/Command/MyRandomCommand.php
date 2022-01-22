<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\{Input\ArrayInput, Input\InputInterface, Output\OutputInterface};

class MyRandomCommand extends Command
{
    protected static $defaultName = 'my:random:command';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $application = $this->getApplication();
        $command = $application->find('command name');
        $inputs = new ArrayInput(['argument'=>'value', '--option' => 'value']);

        $exitCode = $command->run($inputs, $output);
        // $application->run($inputs, new NullOutput()); if no output needed

        return Command::SUCCESS;
    }
}