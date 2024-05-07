<?php

declare(strict_types=1);

namespace Yiisoft\Yii\DoctrineFixture;

use Doctrine\Common\DataFixtures\Loader;
use RuntimeException;

use function sprintf;

final class FixtureLoaderManager
{
    public function __construct(
        /** @var Loader[] */
        private array $loaders,
    ) {
        $this->loaders = [];
    }

    public function getLoader(string $entityManagerName): Loader
    {
        $loader = $this->loaders[$entityManagerName] ?? null;

        if (null === $loader) {
            throw new RuntimeException(
                sprintf('Not found loader by name entity manager "%s"', $entityManagerName)
            );
        }

        return $loader;
    }

    /**
     * @return Loader[]
     */
    public function getLoaders(): array
    {
        return $this->loaders;
    }
}
