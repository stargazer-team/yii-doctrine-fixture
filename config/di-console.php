<?php

declare(strict_types=1);

use Yiisoft\Yii\DoctrineFixture\Factory\FixtureFactory;
use Yiisoft\Yii\DoctrineFixture\FixtureLoaderManager;

/** @var array $params */

return [
    FixtureLoaderManager::class => static fn(
        FixtureFactory $fixtureFactory
    ): FixtureLoaderManager => $fixtureFactory->create($params['yiisoft/yii-doctrine-fixture'] ?? []),
];
