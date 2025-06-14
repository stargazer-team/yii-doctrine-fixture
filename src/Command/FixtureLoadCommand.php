<?php

declare(strict_types=1);

namespace Yiisoft\Yii\DoctrineFixture\Command;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Yiisoft\Yii\Console\ExitCode;
use Yiisoft\Yii\Doctrine\DoctrineManager;
use Yiisoft\Yii\DoctrineFixture\FixtureLoaderManager;

use function sprintf;

final class FixtureLoadCommand extends Command
{
    public function __construct(
        private readonly DoctrineManager $doctrineManager,
        private readonly FixtureLoaderManager $fixtureLoaderManager,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('doctrine:fixture:load')
            ->setDescription('Load fixture')
            ->addOption('em', 'e', InputOption::VALUE_REQUIRED, 'Entity manager name')
            ->addOption(
                'excluded',
                mode: InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                description: 'Exclude purge tables',
                default: [],
            )
            ->addOption(
                'append',
                mode: InputOption::VALUE_NONE,
                description: 'Fixtures instead of purging before loading',
            )
            ->setHelp(
                <<<EOT
The <info>%command.name%</info> command load fixture:

You can also optionally specify the name of the entity manager:

    <info>php %command.full_name% --em=default --exclude=table_name</info>
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $emName */
        $emName = $input->getOption('em');

        $loader = $this->fixtureLoaderManager->getLoader($emName);

        $entityManager = $this->doctrineManager->getManager($emName);

        /** @psalm-var array<array-key, string> $excludedTables */
        $excludedTables = $input->getOption('excluded');

        $append = (bool)$input->getOption('append');

        $executor = new ORMExecutor(
            $entityManager,
            new ORMPurger($entityManager, $excludedTables),
        );
        $executor->execute($loader->getFixtures(), $append);

        $output->writeln(sprintf('<info>Load fixture for entity manager "%s"</info>', $emName));

        return ExitCode::OK;
    }
}
