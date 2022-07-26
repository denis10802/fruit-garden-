<?php

namespace App\Command;

use App\Enum\TreeType;
use App\Service\FruitGardenService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PlantAppleCommand extends Command
{
    protected static $defaultName = 'app:plant:apple';
    protected static $defaultDescription = 'Посадка яблони в саду';

    private FruitGardenService $fruitGardenService;

    public function __construct(
      FruitGardenService $fruitGardenService,
    )
    {
        $this->fruitGardenService = $fruitGardenService;
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->fruitGardenService->createTree(TreeType::Apple,10, 40, 50);
        $io->success('Посажены яблони в саду');

        return Command::SUCCESS;
    }
}
