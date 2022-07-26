<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FruitPickerCommand extends Command
{
    protected static $defaultName = 'app:fruit:picker';
    protected static $defaultDescription = 'Запуск автоматического сборщика фруктов';

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $app = $this->getApplication();

        if (!$app) {
            $io->error('App not defined!');
            return Command::FAILURE;
        }

        $commands = [
            'app:plant:apple',
            'app:plant:pear',
            'app:harvest',
        ];

        foreach ($commands as $command) {
            $app->find($command)->run($input, $output);
        }

        return Command::SUCCESS;
    }
}
