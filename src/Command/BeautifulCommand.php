<?php

declare(strict_types=1);

namespace App\Command;

use App\Console\MyAwesomeStyle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\{Input\InputInterface, Output\OutputInterface};
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\TableSeparator;

class BeautifulCommand extends Command
{
    protected static $defaultName = 'my:beautiful:command';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //<editor-fold desc="initiate the symfony style">
        $styler = new SymfonyStyle($input, $output);
        //</editor-fold>
        //<editor-fold desc="Titling">
        $styler->title('This is a title'); // global command title
        $styler->section('Section title'); // a section title
        //</editor-fold>
        //<editor-fold desc="Text">
        // displaying a simple text
        $styler->text('A simple message');
        $styler->text(['line 1', 'line 2', 'line 3']);
        // show an unordered list
        $styler->listing(['Item #1', 'Item #2', 'Item #3']);
        //</editor-fold>
        //<editor-fold desc="Tables">
        // rendering a random table
        $styler->table(
            ['Header 1', 'Header 2'],
            [
                ['Cell 1-1', 'Cell 1-2'],
                ['Cell 2-1', 'Cell 2-2'],
                ['Cell 3-1', 'Cell 3-2'],
            ],
        );
        $styler->horizontalTable(
            ['Header 1', 'Header 2'],
            [
                ['Cell 1-1', 'Cell 1-2'],
                ['Cell 2-1', 'Cell 2-2'],
                ['Cell 3-1', 'Cell 3-2'],
            ]
        );
        // rendering a definition list
        $styler->definitionList(
            'This is a title',
            ['foo1' => 'bar1'],
            ['foo2' => 'bar2'],
            ['foo3' => 'bar3'],
            new TableSeparator(),
            'This is another title',
            ['foo4' => 'bar4']
        );
        // create a table dynamically
        $styler->createTable()->addRow(row: [/*Add dynamically a row*/])->render();// render the table
        //</editor-fold>
        // add  new line
        $styler->newLine(/*number of line to add or 1 if not set*/);
        // add a note
        //<editor-fold desc="Notes and cautions">
        $styler->note('This is a note');
        $styler->note([
            'Item #1',
            'Item #2',
            'Item #3',
        ]);

        // add a caution
        $styler->caution('This is a caution message');
        $styler->caution([
            'Item #1',
            'Item #2',
            'Item #3',
        ]);
        //</editor-fold>
        //<editor-fold desc="Progress bar">
        // add a progression bar
        $styler->progressStart(/*steps. if none given, then unknown length*/);
        $styler->progressStart(100);
        for ($i = 0; $i < 100; $i+=10) {
            $styler->progressAdvance(10); // advance the progress bar with 1
            \sleep(1);
        }
        // when the length is unknown, it fills the remaining steps in the progress bar
        $styler->progressFinish();

        // we can iterate over an array (iterable)
        $data = [/*Some data*/];
        foreach ($styler->progressIterate($data) as $value) {
            // do something
        }
        $progress = $styler->createProgressBar(100);
        //</editor-fold>
        //<editor-fold desc="Questioning">
        $name = $styler->ask('What is your name ?');
        $age = $styler->ask(question: 'How old are you ?', validator: function ($age) {
            if (false === \is_numeric($age)) {
                throw new \RuntimeException('The value you provided is not a valid number');
            }

            return (int) $age;
        });
        $language = $styler->ask('Your current location ?', 'Morocco');
        //</editor-fold>
        //<editor-fold desc="Hidden inputs">
        $secret = $styler->askHidden('Please provide a phrase pass');
        $password = $styler->askHidden('Please provide a password: ', function ($password) {
            if (\strlen($password) < 8) {
                throw new \RuntimeException('The password must have at least 8 chars');
            }

            return $password;
        });
        //</editor-fold>
        //<editor-fold desc="Confirm">
        $response = $styler->confirm('Do you want to continue ?');
        $response = $styler->confirm('Do you want to continue ?', false);
        //</editor-fold>
        //<editor-fold desc="Choices">
        $myFavoriteLanguage = $styler->choice(
            question: 'Which is your favorite programming language?',
            choices: ['PHP', 'JAVA', 'PYTHON', 'C#'],
            default: 'PHP'
        );
        //</editor-fold>
        //<editor-fold desc="Result messages">
        $styler->success('this is a success message');
        $styler->success(['line 1', 'line 2', 'line 3']);

        $styler->info('this is an info message');
        $styler->info(['line 1', 'line 2', 'line 3']);

        $styler->warning('this is a warning message');
        $styler->warning(['line 1', 'line 2', 'line 3']);

        $styler->error('this is an error message');
        $styler->error(['line 1', 'line 2', 'line 3']);
        //</editor-fold>

        $myAwesomeStyle = new MyAwesomeStyle($input, $output);

        if ($output->isVerbose()) {
            // ....
        }


        $output->writeln(
            'Some message',
            OutputInterface::VERBOSITY_DEBUG
        );

        return Command::SUCCESS;
    }
}