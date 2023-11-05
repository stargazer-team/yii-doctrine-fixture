<?php

declare(strict_types=1);

use Yiisoft\Yii\DoctrineFixture\Command\FixtureLoadCommand;

return [
    'yiisoft/yii-console' => [
        'commands' => [
            'doctrine:fixture:load' => FixtureLoadCommand::class,
        ],
    ],
    'yiisoft/yii-doctrine-fixture' => [],
];
