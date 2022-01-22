<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\CurrencyConverter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\{Input\InputInterface, Input\InputArgument, Input\InputOption, Output\OutputInterface};

/**
 * Console command to convert currencies using https://fixer.io/ API.
 */
class CurrencyConvertCommand extends Command
{
    protected static $defaultName = 'app:currency:convert';

    protected static $defaultDescription = 'Converts from a currency to currency using the data.fixer.io API ';

    private CurrencyConverter $converter;

    public function __construct(CurrencyConverter $converter)
    {
        $this->converter = $converter;

        parent::__construct();
    }

    protected function configure(): void
    {
        //<editor-fold desc="// Arguments">
        $this->addArgument(name: 'from', mode: InputArgument::REQUIRED, description: 'From currency')
            ->addArgument(name: 'to', mode: InputArgument::REQUIRED, description: 'To currency')
            ->addArgument(
                name: 'amount',
                mode: InputArgument::OPTIONAL,
                description: 'The amount to be converted.',
                default: 1
            );
        //</editor-fold>
        $this->addOption(
            default: true,
            name: 'save',
            mode:InputOption::VALUE_NONE|InputOption::VALUE_NEGATABLE,
            description: 'If set, the data retrieved will be persisted to database',
            shortcut: 's'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $save = $input->getOption('save');
        //<editor-fold desc="// ...">
        $amount = (int) $input->getArgument('amount');
        $from = $input->getArgument('from');
        $to = $input->getArgument('to');
        $result = $this->converter->convert($from, $to, $amount);
        if (null === $result) {
            return Command::FAILURE;
        }
        $output->writeln(\sprintf('Converting %f from %s to %s : %f', $amount, $from, $to, $result));

        return Command::SUCCESS;
        //</editor-fold>
    }
}
