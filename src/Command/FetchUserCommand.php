<?php

declare(strict_types=1);

namespace App\Command;

//<editor-fold desc="Use statements">
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\{Input\InputInterface, Output\ConsoleOutputInterface, Output\OutputInterface};

//</editor-fold>

class FetchUserCommand extends Command
{
    //<editor-fold desc="Name and description of the command">
    protected static $defaultName = 'app:user:fetch';

    protected static $defaultDescription = 'This is a description';
    //</editor-fold>

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct();
    }

    //<editor-fold desc="//...">
    protected function configure(): void
    {
        $this->setDescription('This is a description for the command');
        $this->setHelp('This is a help');
    }

    protected function execute(InputInterface $in, OutputInterface $out): int
    {
        //<editor-fold desc="Because section() method is defined in the ConsoleOutputInterface">
        if (!$out instanceof ConsoleOutputInterface) {
            throw new \LogicException('...');
        }
        //</editor-fold>

        //<editor-fold desc="Create some sections">
        $userSection = $out->section();
        $addressSection = $out->section();
        //</editor-fold>

        //<editor-fold desc="Fill sections with some content">
        $userSection->writeln(messages: 'This is an example of writeln()', options: OutputInterface::VERBOSITY_VERBOSE);
        $addressSection->writeln(messages: [
            'Ipsum lorem',
            'Dolor',
            '60000, sit amet',
        ]);
        //</editor-fold>

        //<editor-fold desc="Clear section">
        $userSection->clear(/*You can put here number of line to clear*/);
        //</editor-fold>

        //<editor-fold desc="Overwrite section">
        $addressSection->overwrite(message: [
            'Vivamus non faucibus',
            'Quisque id velit',
        ]);
        //</editor-fold>

        return Command::FAILURE;
    }
    //</editor-fold>
}