<?php

namespace App\Command;

use App\Enum\TreeType;
use App\Service\FruitGardenService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class HarvestingCommand extends Command
{

    protected static $defaultName = 'app:harvest';
    protected static $defaultDescription = 'Сбор урожая';

    private FruitGardenService $fruitGardenService;

    public function __construct(
        FruitGardenService $fruitGardenService
    )
    {
        $this->fruitGardenService = $fruitGardenService;
        parent::__construct();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $treeApple =  $this->fruitGardenService->countTree(TreeType::Apple);
        $numberFruitsApple = $this->fruitGardenService->countFruits(TreeType::Apple);

        $io->success('Собрано из '.$treeApple. ' яблонь '. $numberFruitsApple. ' плодов');

        $treePear =  $this->fruitGardenService->countTree(TreeType::Pear);
        $numberFruitsPear = $this->fruitGardenService->countFruits(TreeType::Pear);

        $io->success('Собрано из '.$treePear. ' груш '. $numberFruitsPear. ' плодов');


        return Command::SUCCESS;
    }
}
