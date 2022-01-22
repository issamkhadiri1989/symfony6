<?php

declare(strict_types=1);

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class FetchUserCommandTest extends KernelTestCase
{
    public function testExecute(): void
    {
        // get the kernel
        $kernel = self::bootKernel();
        // initialize the application
        $application = new Application($kernel);
        // find the command by name
        $command = $application->find(name: 'app:user:fetch');
        // create the command tester
        $tester = new CommandTester($command);
        // call the execute() method
        $tester->execute(input: []);
        // check first that the command has been successfully executed
        $tester->assertCommandIsSuccessful();
        // get the command output
        $output = $tester->getDisplay();
        // ... do something with the output like
        $this->assertStringContainsString(needle: 'Line 1', haystack: $output);
    }
}
