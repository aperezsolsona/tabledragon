<?php

namespace TableDragon\Infrastructure\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TableDragon\Application\Category\PopulateCategories;

final class PopulateCategoriesCommand  extends Command
{
    protected static $defaultName = 'tabledragon:command:populate-categories';
    public function __construct(
        private readonly PopulateCategories $populateCategories
    ) {
        parent::__construct(self::$defaultName);
    }

    protected function configure(): void
    {
        $this->setDescription('Populate TableDragon Categories');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("<info>[PopulateCategoriesCommand] Populating categories in database...</info>");
        $this->populateCategories->__invoke();
        $output->writeln("<info>[PopulateCategoriesCommand] Done!</info>");
        return Command::SUCCESS;
    }
}