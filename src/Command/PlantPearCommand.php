<?php

namespace App\Command;

use App\Enum\TreeType;
use App\Service\FruitGardenService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class PlantPearCommand extends Command
{
    protected static $defaultName = 'app:plant:pear';
    protected static $defaultDescription = 'Посадка груш в саду';

    public function __construct(
        private FruitGardenService $fruitGardenService,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->fruitGardenService->createTree(TreeType::Pear,15, 0, 20);

        $io->success('Посажены груши в саду');

        return Command::SUCCESS;
    }
}
