<?php

declare(strict_types=1);

namespace Yiisoft\Yii\DoctrineFixture\Factory;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Loader;
use RuntimeException;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Injector\Injector;
use Yiisoft\Yii\DoctrineFixture\Enum\ConfigOptions;
use Yiisoft\Yii\DoctrineFixture\FixtureLoaderManager;

use function sprintf;

final class FixtureFactory
{
    public function __construct(
        private readonly Aliases $aliases,
        private readonly Injector $injector,
    ) {
    }

    /**
     * @psalm-param array{
     *     entity_managers: array<string, array{
     *          dirs: array<string>|empty,
     *          files: array<string>|empty,
     *          classes: array<class-string<FixtureInterface>>|empty
     *     }>|empty
     *  } $fixtureConfig
     */
    public function create(array $fixtureConfig): FixtureLoaderManager
    {
        $fixtureLoaders = [];

        if (isset($fixtureConfig[ConfigOptions::ENTITY_MANAGERS])) {
            foreach ($fixtureConfig[ConfigOptions::ENTITY_MANAGERS] as $entityManagerName => $config) {
                $loader = new Loader();

                $this->loadClasses($loader, $config[ConfigOptions::CLASSES] ?? []);
                $this->loadDirs($loader, $config[ConfigOptions::DIRS] ?? []);
                $this->loadFiles($loader, $config[ConfigOptions::FILES]);

                $fixtureLoaders[$entityManagerName] = $loader;
            }
        }

        return new FixtureLoaderManager($fixtureLoaders);
    }

    /**
     * @psalm-param array<class-string<FixtureInterface>> $classes
     */
    private function loadClasses(Loader $loader, array $classes): void
    {
        foreach ($classes as $classFixture) {
            $fixture = $this->injector->make($classFixture);

            if (!$fixture instanceof FixtureInterface) {
                throw new RuntimeException(
                    sprintf('Class %s not instanceof %s', $classFixture, FixtureInterface::class)
                );
            }

            $loader->addFixture($fixture);
        }
    }

    /**
     * @psalm-param array<string>|array<empty> $dirs
     */
    private function loadDirs(Loader $loader, array $dirs): void
    {
        foreach ($dirs as $dir) {
            $loader->loadFromDirectory($this->aliases->get($dir));
        }
    }

    /**
     * @psalm-param array<string>|array<empty> $files
     */
    private function loadFiles(Loader $loader, array $files): void
    {
        foreach ($files as $file) {
            $loader->loadFromFile($this->aliases->get($file));
        }
    }
}
